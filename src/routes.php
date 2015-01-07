<?php

namespace ThreadsAndTrolls;

use ThreadsAndTrolls\Entity\Adventure;
use ThreadsAndTrolls\Entity\AdventureCharacter;
use ThreadsAndTrolls\Entity\Character;
use ThreadsAndTrolls\Entity\EventJoin;
use ThreadsAndTrolls\Entity\EventLevelUp;
use ThreadsAndTrolls\Entity\EventMonsterAttack;
use ThreadsAndTrolls\Entity\EventMonsterSpawn;
use ThreadsAndTrolls\Entity\EventRewardExperience;
use ThreadsAndTrolls\Entity\Monster;
use ThreadsAndTrolls\Entity\MonsterModel;
use ThreadsAndTrolls\Entity\Profession;
use ThreadsAndTrolls\Entity\Race;
use ThreadsAndTrolls\Entity\Ability;
use ThreadsAndTrolls\Entity\Statistic;

$klein->respond('GET', '/', function($request) {

    $templatePart = "doc";
    include(__DIR__ . "/../views/template.php");

});

$klein->respond('GET', '/character/[:id]', function($request) {

    $characterId = $request->id;
    $character = Character::getCharacter($characterId);

    if ($character == null) {
        return "Personnage pas trouvé";
    }

    $stats = Statistic::getAllStatistics();

    $displayedStatsId = array(Statistic::STRENGTH, Statistic::INTELLIGENCE, Statistic::DEXTERITY);
    $displayedStats = array();
    // It contains only the idea, so we go find the correct Statistic instance for all those IDs
    foreach ($displayedStatsId as $statId) {
        $displayedStats[] = Statistic::getStatistic($statId);
    }

    $templatePart = "character";
    include(__DIR__ . "/../views/template.php");
});


$klein->respond('GET', '/jol/[:code]', function($request) {

    $messageLoader = new \ThreadsAndTrolls\JolMessageLoader($request->code);
    $adventure = checkGame("jol", $request->code, $messageLoader->loadMessages());

    if ($adventure != null) {
        displayGame($adventure);
    } else {
        echo "Aucune partie.";
    }


});

function displayGame(Adventure $adventure) {

    $events = array_reverse($adventure->getEvents()->toArray());

    $templatePart = "game";
    include(__DIR__ . "/../views/template.php");
}

function checkGame($type, $code, $messages) {

    if (count($messages) == 0) {
        return null;
    }

    // We check first if there's a registered adventure with this code
    $adventure = Adventure::getGame($type, $code);

    $master = $messages[0]["user"];

    if ($adventure == null) {

        // We create a Adventure
        $adventure = Adventure::createGame($master, $type, $code);

    }

    // We now check if there are new messages
    foreach ($messages as $message) {
        $lastTreatedMessage = $adventure->getLastTreatedMessage();

        $user = $message["user"];

        if ($message["id"] > $lastTreatedMessage) {

            // New message ! We process it
            $actionsRaw = ActionParser::loadActions($message["text"]);

            foreach ($actionsRaw as $actionRaw) {

                processAction($adventure, $user, $actionRaw);

            }

            // We set the message as threaded
            $adventure->setLastTreatedMessage($message["id"]);

        }
    }

    return $adventure;
}

function processAction(Adventure $adventure, $user, $action) {
    try {

        $actionName = strtolower($action["name"]);
        $actionArgs = $action["args"];

        $character = Character::getCharacterByOwner($user);

        if ($user == $adventure->getMaster()) {

            // Special commands for the dungeonmaster
            if ($actionName == "spawn") {

                $monsterModel = MonsterModel::getMonsterModel($actionArgs[0]);

                if ($monsterModel != null) {

                    $monster = Monster::createMonster($monsterModel, $adventure);

                    EventMonsterSpawn::createMonsterSpawn($adventure, $monster);

                }

            } else if ($actionName == "experience") {

                $character = Character::getCharacterByName($actionArgs[0]);
                if ($character != null) {

                    $experience = $actionArgs[1];

                    $countLevelGained = $character->rewardExperience($experience);
                    EventRewardExperience::createEventRewardExperience($adventure, $character, $experience);

                    for ($i = $countLevelGained-1;$i >= 0;$i--) {
                        EventLevelUp::createEventLevelUp($adventure, $character, $character->getLevel() - $i);
                    }
                }

            } else if ($actionName == "experienceall") {

                foreach ($adventure->getCharacters() as $targetCaracter) {
                    // TODO
                }

            } else if ($actionName == "teststat") {

                // testStat@characterName,statisticTag,requiredAmount,countDice'd'countDiceSide
                $targetCharacter = Character::getCharacterByName($actionArgs[0]);
                if ($targetCharacter != null) {

                    $targetAdventureCharacter = AdventureCharacter::getAdventureCharacter($targetCharacter, $adventure);
                    if ($targetAdventureCharacter != null) {

                        $statistic = Statistic::getStatisticByTag($actionArgs[1]);
                        if ($statistic != null) {

                            list($countDice, $countDiceSide) = explode('d', $actionArgs[3]);
                            $requiredAmount = $actionArgs[2];
                            $diceRoll = new DiceRoll($countDice, $countDiceSide);

                            $targetAdventureCharacter->testStatistic($statistic, $diceRoll, $requiredAmount);
                        }

                    }
                }
            } else if ($actionName == "monsterattack") {

                $monster = Monster::getMonster($actionArgs[0]);
                if ($monster != null) {

                    $targetCharacter = Character::getCharacterByName($actionArgs[1]);
                    if ($targetCharacter != null) {

                        $targetAdventureCharacter = AdventureCharacter::getAdventureCharacter($targetCharacter, $adventure);
                        if ($targetAdventureCharacter != null) {
                            $damage = $monster->attack($targetAdventureCharacter);
                            EventMonsterAttack::createMonsterAttack($adventure, $monster, $targetAdventureCharacter, $damage);
                        }
                    }
                }
            }
        }

        if ($character != null) {

            // Commands for users who already has a character
            // We check if he's already in the adventure or not
            $adventureCharacter = AdventureCharacter::getAdventureCharacter($character, $adventure);
            if ($adventureCharacter != null) {

                // Commands for those who are in the adventure
                if ($actionName == "attack") {

                    $monster = Monster::getMonster($actionArgs[0]);

                    if ($monster != null) {
                        $damage = $adventureCharacter->attack($monster);
                    }

                } else if ($actionName == "useability") {

                    $ability = Ability::getAbilityByTag($actionArgs[0]);
                    if ($ability != null) {

                        $argumentsRaw = array_slice($actionArgs, 1);
                        // We check if the arguments given by the user are good (good nicknames, ...)
                        $arguments = $ability->processArguments($adventure, $adventureCharacter, $argumentsRaw);

                        if ($arguments !== false) {
                            $adventureCharacter->useAbility($ability, $arguments);
                        }
                    }

                }

            } else {

                // Commands for those who aren't in the adventure
                if ($actionName == "join") {

                    if ($character != null) {
                        $adventureCharacter = AdventureCharacter::joinAdventure($character, $adventure);
                        EventJoin::createEventJoin($adventure, $character);
                    }

                }
            }

            if ($actionName == "assignstats") {

                $totalSum = 0; // The total amount of stat the user wants to assign
                $assignStats = array();

                foreach ($actionArgs as $assignStatsRaw) {
                    $assignStat = explode("=", $assignStatsRaw);
                    if ($assignStat > 0) {
                        $assignStats[] = $assignStat;
                        $totalSum += $assignStat[1];
                    }

                }

                // We check if the user didn't assign too much points
                if ($totalSum <= $character->getStatisticPoints()) {
                    foreach ($assignStats as $assignStat) {
                        $stat = Statistic::getStatisticByTag($assignStat[0]);
                        if ($stat != null) {
                            $character->assignStatistic($stat, $assignStat[1]);
                        }
                    }
                }

            }


        } else {

            // Commands for users who have no character
            if ($actionName == "createcharacter") {

                // We check if the race exists
                $name = $actionArgs[0];
                $race = Race::getRaceByTag($actionArgs[1]);
                $profession = Profession::getProfessionByTag($actionArgs[2]);

                if ($race != null) {
                    $character = Character::createCharacter($user, $name, $race, $profession);
                }

            }
        }
    } catch (Exception $e) {
        return false;
    }

    return true;
}