<?php


namespace ThreadsAndTrolls\MessageLoader;


class JolMessageLoader {
    private $threadId;

    public function __construct($threadId) {
        $this->threadId = $threadId;
    }

    public function loadMessages() {
        $url = "http://flux.jeuxonline.info/fil-" . $this->threadId . "-50.rss";

        $rssRaw = file_get_contents($url);
        //$rssRaw = file_get_contents(__DIR__ . "/test.xml"); // Fake RSS input for testing

        $messages = array();

        $dom = new \DOMDocument();

        $dom->loadXML($rssRaw);

        $itemsNode = $dom->getElementsByTagName("item");
        if ($itemsNode->length > 0) {
            for ($i = 0; $i < $itemsNode->length; $i++) {
                $item = $itemsNode->item($i);

                $messageInfo = array();

                $itemsDataNodes = $item->childNodes;
                for ($j = 0; $j < $itemsDataNodes->length; $j++) {
                    $dataItem = $itemsDataNodes->item($j);

                    if ($dataItem->nodeName == "link") {

                        // We use the link tag to parse the url and get the id of the post
                        $toParseUrl = $dataItem->textContent;
                        preg_match('/.*#([0-9]*)/i', $toParseUrl, $matches);
                        $messageInfo["id"] = $matches[1];

                    } else if ($dataItem->nodeName == "description") {

                        $messageInfo["text"] = $dataItem->textContent;

                    } else if ($dataItem->nodeName == "author") {

                        $messageInfo["user"] = $dataItem->textContent;

                    }
                }

                $messages[] = $messageInfo;
            }
        }

        return array_reverse($messages);
    }
} 