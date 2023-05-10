<?php

namespace miles_podcast;

class RssFeedReader
{
    const FEED_URL = "https://feeds.acast.com/public/shows/63d28f41cd0f720011930608";

    private function get_rss(): \SimpleXMLElement|false
    {
        return simplexml_load_file(self::FEED_URL);
    }

    public function get_episodes(): array
    {
        $xml = $this->get_rss();

        $items = array();
        foreach ($xml->channel->item as $item) {
            $items[] = array(
                "episode_title" => $item->title->__toString(),
                "published_date" => $item->pubDate->__toString(),
                "link" => $item->link->__toString(),
                "description" => $item->description->__toString(),
                "length" => $item->enclosure->attributes()["length"]->__toString(),
            );
        }

        return $items;
    }

    public function get_latest_episode()
    {
        return $this->get_episodes()[0];
    }
}