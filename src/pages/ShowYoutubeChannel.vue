<template>

  <q-page>
    <div align="center" style="margin-top:30px;">
    <q-card align="center" style="width: 1000px; height: 50px;">
      <b style="font-size:25px; color:blue;">Channel Title: {{ this.channelTitle }}</b> </q-card>
    <br/>
     <q-table
              :data="videoList"
              :columns="columns"
              row-key="ListId"  
            ><template v-slot:top-left>
              <span class="material-icons" style="font-size:25px; color:red;">
video_library
</span>
                <b style="font-size: 25px; color:blue;">List of Videos</b>
              </template></q-table>
    </div>
  </q-page>
  
</template>

<script>
import axios from 'axios'


export default {
  name: 'PageIndex',
  data(){
    return {
      channelId: "",
      channelTitle: "",
      channelDesc: "",
      channelPic: "",
      videoList: [],
      videoList2: [],
     columns: [
        {
          label: "Video Title",
          align: "center",
          name: "videoTitle",
          field: "videoTitle",
          sortable: true,
        },
        {
          label: "Description",
          align: "center",
          name: "description",
          field: "description",
          sortable: true,
        },
         {
          label: "Thumbnail",
          align: "center",
          name: "thumbnail",
          field: "thumbnail",
          sortable: true,
        },

      ],
    }
  },
   created(){
     this.getFirst50Videos();
     this.getOther50Videos();
      this.savingData();
    },
  

  methods: {
    savingData(){
          alert("Saving data. Wait a few seconds.");
          
    },
    getFirst50Videos(){
       axios.get('./youtube_channel.json', {
        params: {
          part: 'snippet',
          channelId: 'UCWJ2lWNubArHWmf3FIHbfcQ',
          maxResults: 50,  
          q: 'NBA',
          key: 'AIzaSyCT-KSU62aWm5C3HE2RJNv4cQ2loCbQPv0' 
        }
      }).then(
           res => {
             for(var i = 0; i < res.data.items.length; i++){
               this.channelTitle = res.data.items[i].snippet.channelTitle;
              this.channelId = res.data.items[i].snippet.channelId;
               this.videoList.push({
                  channelId: res.data.items[i].snippet.channelId,
                 videoId: res.data.items[i].id.videoId,
                 videoTitle: res.data.items[i].snippet.title,
                 description: res.data.items[i].snippet.description,
                 thumbnail: res.data.items[i].snippet.thumbnails.default.url
               })
             }
    
           }
      ); 
    },
    getOther50Videos(){
      axios.get('./youtube_channel2.json', { 
        params: {
          part: 'snippet',
          channelId: 'UCWJ2lWNubArHWmf3FIHbfcQ',
            maxResults: 50,  
          q: 'NBA',
          key: 'AIzaSyCT-KSU62aWm5C3HE2RJNv4cQ2loCbQPv0' 
        }
      }).then(
           res => {
             for(var i = 0; i < res.data.items.length; i++){
               this.channelTitle = res.data.items[i].snippet.channelTitle;
              this.channelId = res.data.items[i].snippet.channelId;
               this.videoList.push({
                 channelId: res.data.items[i].snippet.channelId,
                  videoId: res.data.items[i].id.videoId,
                 videoTitle: res.data.items[i].snippet.title,
                 description: res.data.items[i].snippet.description,
                 thumbnail: res.data.items[i].snippet.thumbnails.default.url
               })
             }
              setTimeout(this.saveAllInfo(), 50000);
           }
      );

      
    },
    saveAllInfo(){

      this.$store.dispatch('SAVE_ALL_INFO', {
          channelTitle: this.channelTitle,
          channelId: this.channelId,
          videoList: this.videoList
      }).then(res => { alert("Data successfully saved!"); });
    
    }
  
  }  
  
}

</script>