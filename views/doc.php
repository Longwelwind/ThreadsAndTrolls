
<div class="column-group">
    <div class="all-25">
        <div id="menu" class="ink-navigation">
            <ul class="menu vertical white">
                <li>
                    <a>Qu'est-ce que c'est ?</a>
                </li>
                <li class="heading">
                    <a>Personnage</a>
                </li>
                <li>
                    <a>Caractéristiques</a>
                </li>
                <li>
                    <a>Races</a>
                </li>
                <li>
                    <a>Classes</a>
                </li>
                <li>
                    <a>"Level up !"</a>
                </li>
                <li class="heading">
                    <a>Comment jouer</a>
                </li>
                <li>
                    <a>Créer un personnage</a>
                </li>
                <li class="heading">
                    <a>Maître du jeu</a>
                </li>
                <li>
                    <a>Monstres</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="all-75">
        <div style="margin-left: 15px;">

            <h3>Qu'est-ce que c'est ?</h3>
            <p>
                Threads & Throlls est un jeu qui vous permet d'incarner le héros de votre choix dans des
                aventures épiques narrées par un maître du jeu. Il se déroule sur les topics de JoL où
                vous jouez en écrivant des messages spécifiques pour réaliser des actions. Le principale de
                l'aventure se passe donc dans le thread, et ce site vous permet de voir l'avancée du groupe
                dans les combats.
            </p>
            <p>
                Vous pouvez accéder à une fiche détaillée de votre personnage en cliquant sur le nom de celui-ci
                dans le jeu.
            </p>

            <h2>Personnage</h2>
            <p>

                Votre personnage aura une race, une classe, des caractéristiques, des sorts, un niveau, de l'experience,
                ...
            </p>
            <h3>Caractéristiques</h3>
            <p>
                <!-- TODO: introduction -->
            </p>
            <table class="ink-table bordered">
                <tr>
                    <th>Caractéristique (tag)</th>
                    <th></th>
                </tr>
                <tr>
                    <td>Force (str)</td>
                    <td>
                        La Force représente la condition physique de votre personnage
                    </td>
                </tr>
                <tr>
                    <td>Intelligence (int)</td>
                    <td>
                        L'intelligence représente l'ingéniosité de votre personnage. Elle définit la
                        capacité de celui-ci à élaborer des plans, à convaincre les autres (particulièrement
                        les ennemis).<br />
                        Une grande intelligence permet aussi aux magiciens de réaliser des sorts magiques plus
                        puissants.
                    </td>
                </tr>
                <tr>
                    <td>Dextérité (dex)</td>
                    <td>

                    </td>
                </tr>
            </table>

            <h3>Races</h3>
            <p>
                <!-- TODO: introduction-->
            </p>
            <table class="ink-table bordered">
                <tr>
                    <th>Nom (tag)</th>
                    <th>Vie max.</th>
                    <th>Force</th>
                    <th>Intelligence</th>
                    <th>Dexterité</th>
                </tr>
                <tr>
                    <td>Nain <i>(dwarf)</i></td>
                    <td>120</td>
                    <td>7</td>
                    <td>4</td>
                    <td>4</td>
                </tr>
                <tr>
                    <td>Elfe <i>(elf)</i></td>
                    <td>80</td>
                    <td>5</td>
                    <td>8</td>
                    <td>5</td>
                </tr>
                <tr>
                    <td>Humain <i>(human)</i></td>
                    <td>100</td>
                    <td>6</td>
                    <td>6</td>
                    <td>5</td>
                </tr>
                <tr>
                    <td>Kender <i>(kender)</i></td>
                    <td>70</td>
                    <td>3</td>
                    <td>5</td>
                    <td>8</td>
                </tr>
            </table>

            <h3>Classes</h3>
            <table class="ink-table bordered">
                <tr>
                    <th>Nom (tag)</th>
                    <th>Rôle(s)</th>
                </tr>
                <tr>
                    <td>Guerrier <i>(warrior)</i></td>
                    <td>
                        Combattant physique<br />
                        Support
                    </td>
                </tr>
                <tr>
                    <td>Sorcier <i>(wizzard)</i></td>
                    <td>
                        Combattant magique<br />
                        Saboteur
                    </td>
                </tr>
                <tr>
                    <td>Clerc <i>(clerc)</i></td>
                    <td>
                        Soigneur<br />
                        Support<br />
                    </td>
                </tr>
                <tr>
                    <td>Voleur <i>(rogue)</i></td>
                    <td>
                        Combattant physique<br />
                        Saboteur
                    </td>
                </tr>
            </table>

            <h3>"Level up" !</h3>
            <p>
                Une fois que vous gagnez assez de points d'experience, vous passerez au niveau suivant. Le gain d'un
                niveau vous apporte <b>2</b> points de caractéristiques.
            </p>
            <h4>
                Caractéristiques
            </h4>
            <p>
                Pour assigner les points de caractéristiques, il faut utiliser la commande assignStats, en specifiant la
                quantité de caractéristiques à attribuer.
                Par exemple, si j'ai 5 points à attribuer et que j'ai envie d'en mettre 2 en Dextérité et 3 en Force:
                <pre>assignstats@dex=2,str=3</pre>
            </p>

            <h2>Comment jouer</h2>
            <h3>Créer un personnage</h3>
            <p>
                Une fois que vous avez choisies quel personnage vous voulez jouer, vous pouvez le créer en
                utilisant la commande ci-dessous:
                <pre>createCharacter@name,raceTag,classTag</pre>
                Où
                <ul>
                    <li><b>name</b> correspond au nom de votre personnage</li>
                    <li><b>raceTag</b> correspond au tag de la race de votre personnage</li>
                    <li><b>classTag</b> correspond au tag de la classe de votre personnage</li>
                </ul>
                Exemple: si vous voulez créer un Nain Guerrier qui s'appelle "Durandil" :
                <pre>createCharacter@Durandil,dwarf,warrior</pre>
            </p>
            <h3>Rejoindre une aventure</h3>
            <p>
                Une fois que vous avez crée votre personnage, vous pouvez tout simplement rejoindre une partie en cours
                en écrivant:
                <pre>join@</pre>
            </p>
            <h2>Maître du jeu</h2>
            <p>
                En tant que maître du jeu, vous avez accès à tout un panel de commandes pour gérer le jeu et les
                obstacles qui se drèsseront sur la route de vos héros.
            </p>
            <h3>Monstres</h3>
            <p>
                Pour faire apparaître un monstre...
            </p>
        </div>
    </div>

</div>