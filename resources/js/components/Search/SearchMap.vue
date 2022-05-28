<template>
  <div>
    <GmapMap
        :center="mapPosition"
        :zoom="16"
        map-type-id="terrain"
        style="height: 90vh;"
    >
        <!-- <GmapMarker
            :position="mapPosition"
            :clickable="true"
            :draggable="true"
        /> -->
        <GmapCluster
            :minimumClusterSize="2"
            :zoomOnClick="true"
        >
            <GmapMarker
                v-for="(gmp, index) in locations"
                :key="index"
                :position="gmp"
                :clickable="true"
                @mouseover="toggleInfoWindow(gmp, index)"
                @click="toggleInfoWindow(gmp, index)"
            >
            </GmapMarker>
        </GmapCluster>

        <GmapInfoWindow
            :position="infoWindowPos"
            :options="infoOptions"
            :opened="postInfoMenu"
            @closeclick="postInfoMenu=false"
        >
            <!-- //* Passing postData as spread object fixed is_vip reading null issue -->
            <PostMapInfo
                :postId="postId"
                :postData="{...postData}"
            />
            <!-- Hello, viewing post id: {{ postId }}
            <br>
            More info:
            <br>
            Post: 
            <br>
            <pre>
                {{ postData }}
            </pre> -->
            <!-- Post user: {{ responseData[currentMidx].id }} -->
        </GmapInfoWindow>


        <!-- <v-menu
            v-model="postInfoMenu"
            :close-on-content-click="false"
            :nudge-width="200"
            offset-x
        >
            <template v-slot:activator="{ on, attrs }">
                <div
                    v-on="on"
                    v-bind="attrs"
                >
                    <GmapMarker
                        v-for="(gmp, index) in locations"
                        :key="index"
                        :position="gmp"
                        :clickable="true"
                    >
                    </GmapMarker>
                </div>
            </template>

            <v-card>
                <p>
                    User: {{ responseData.user_id }}
                </p>
            </v-card>
        </v-menu> -->
        
    </GmapMap>
  </div>
</template>

<script>
import PostMapInfo from "./PostMapInfo.vue";

export default {
    props: ["responseData"],
    components: { PostMapInfo },
    data() {
        return {
            mapPosition: {
                lat: 40.409264,
                lng: 49.867092
            },

            // empty locations array
            locations: [],

            // info menu
            postData: null,
            postInfoMenu: false,
            infoWindowPos: null,
            currentMidx: null,

            infoOptions: {
                pixelOffset: {
                    width: 0,
                    height: -35
                }
            },

            loadingInfoMenu: false
        }
    },
    methods: {
        getMarkerPositions() {
            this.responseData.forEach((data) => {
                this.locations.push(
                    {
                        lat: parseFloat(data.latitude),
                        lng: parseFloat(data.longitude)
                    }
                )
            })
        },

        toggleInfoWindow(marker, idx) {
            this.postData = null;
            
            if(this.loadingInfoMenu == false) {
                console.log("MARKER", marker)
                this.infoWindowPos = {
                    lat: parseFloat(marker.lat),
                    lng: parseFloat(marker.lng)
                }
                console.log(this.infoWindowPos);
    
                //check if its the same marker that was selected if yes toggle
                // * Commenting below code fixed postmap hover
                // if (this.currentMidx == idx) {
                //     this.postInfoMenu = !this.postInfoMenu;
                // }
    
                //if different marker set infowindow to open and reset current marker index
                if (this.currentMidx != idx) {
                    this.postInfoMenu = true;
                    this.currentMidx = idx;
                }
    
                this.fetchPostData(this.postId)
            }
        },

        fetchPostData(id) {
            this.loadingInfoMenu = true
            axios.get(`/api/post/${id}`)
            .then((res) => {
                console.log(res)
                this.postData = res.data
            })
            .catch((err) => {
                console.log(err)
            })
            .finally(() => {
                this.loadingInfoMenu = false
            })
        }
    },
    mounted() {
        console.log("All posts")
        console.log(this.responseData)

        this.getMarkerPositions();
    },
    computed: {
        postId() {
            return this.currentMidx+1
        }
    }
}
</script>

<style>

</style>