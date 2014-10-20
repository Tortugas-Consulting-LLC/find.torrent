<?php

class ItemTest extends \PHPUnit_Framework_TestCase
{
    public function testItemIsJsonSerializable()
    {
        $title = '12 Angry Men';
        $link = 'http://torcache.net/torrent/C01A920D782DE787672E8ECCF36C56A7D6BB509C.torrent?title=[kickass.to]12.angry.men.1957';
        $label = 'KickAss';

        $item = new \FindDotTorrent\Domain\Item($title, $link);
        $item->setLabel($label);

        $jsonResult = array(
            'title' => $title,
            'link' => $link,
            'label' => $label
        );

        $this->assertInstanceOf('JsonSerializable', $item);
        $this->assertEquals($jsonResult, $item->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($jsonResult), json_encode($item));
    }
}