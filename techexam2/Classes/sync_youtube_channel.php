<?php

namespace Classes;

use Classes\Connection;

class sync_youtube_channel{

    public function addAllContent(){
        $data2 = new Connection();
        $db = $data2->Connection();

        
        if(isset($_GET['addId']) && $_GET['addId'] == 1){

            

            $videoData = file_get_contents('php://input');
            $videoDecoded = json_decode($videoData);
            $channelId = $videoDecoded->{'channelId'};
            $channelTitle = $videoDecoded->{'channelTitle'};
            $videoList = $videoDecoded->{'videoList'};

            $addChannelData = array(
                'ChannelId' => $channelId,
                'ChannelName' => $channelTitle, 
               
            );

            $addChannelData2 = $db->insert('youtube_channels', $addChannelData);
            if($addChannelData2){
                echo 'Done1';
            }

            foreach($videoList as $vl){
                if(!empty($vl->videoId)){
            $addVideoData = array(
                'VideoId' => $vl->videoId, 
                'ChannelId' => $vl->channelId,
                'VideoTitle' => $vl->videoTitle, 
                'Thumbnail' => $vl->thumbnail, 
                'Description' => $vl->description
            );
        
            $addVideoData2 = $db->insert('youtube_channel_videos', $addVideoData);
            if($addVideoData2){
                echo 'Done2';
            }
            
            }
        }

            
        
    }
   

    }
}

?>