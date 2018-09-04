<template>
    <div class="container">
        <md-button type="button" class="md-raised md-primary" href="/#/tweetadmin">TABLE</md-button>
        <logout></logout>
        <form class="form">
            <div class="row">
                <div class="col">
                    Latitude:
                    <input type="number" disabled="true" class="form-control" :value="this.parameters.center.lat">
                </div>
                <div class="col">
                    Longtitude:
                    <input type="number" disabled="true" class="form-control" :value="parameters.center.lng">
                </div>
                <div class="col">
                    Radius (km):
                    <input type="number" class="form-control" step="1" min="1" max="100"
                           :value="Math.ceil(parameters.radius/1000)" @change.prevent="transform">
                </div>
                <div class="col">
                    Keyword:{{keyword}}
                    <input type="text" class="form-control" v-model="keyword" placeholder="Keyword">
                </div>
                <md-button class="md-raised md-primary" v-on:click="sendGeoData">SAVE</md-button>
            </div>
        </form>
        <GmapMap :zoom="10" :center="this.parameters.mapCenter"
                 ref="map" @click="clicked">
            <!--<GmapMarker v-if="marker" :position="marker.latLng" :draggable='true' label="Tweet"/>-->
            <GmapMarker v-if="parameters" :position="parameters.position" :draggable='false' label="T"/>

            <GmapCircle v-if="parameters" :center="parameters.center" :radius="parameters.radius" :draggable='true'
                        :editable='true' :options="parameters.options"
                        @radius_changed="radiusChanged" @center_changed="centerChanged"/>
        </GmapMap>
    </div>
</template>

<script>
    import Vue from 'vue'
    import * as VueGoogleMaps from 'vue2-google-maps';
    import {range} from 'lodash';
    import {MdButton} from 'vue-material/dist/components'
    import logout from './LogOut'

    Vue.use(MdButton);

    export default {
        components: {logout},
        data() {
            return {
                keyword: "",
                parameters: {
                    center: {
                        lat: 51.5085300,
                        lng: -0.1257400
                    },
                    position: {
                        lat: 51.5085300,
                        lng: -0.1257400
                    },
                    radius: 5000,
                    options: {
                        strokeColor: '#FF0000',
                        fillColor: '#FF0000',
                    },
                    mapCenter: {
                        lat: 51.5085300,
                        lng: -0.1257400
                    },
                }
            }
        },

        methods: {
            clicked(e) {
                // this.parameters.position = e.latLng;
                this.parameters.center.lat = e.latLng.lat();
                this.parameters.center.lng = e.latLng.lng();
                this.parameters.position = e.latLng();

                // var lat = e.latLng.lat();
                // var lng = e.latLng.lng();
                // var coordinates = lat + ", " + lng;
                // console.log(coordinates + "coord");
                // console.log(this.parameters.position.lat())
            },
            centerChanged(e) {
                // console.log(e);
                // console.log(e.lat() + ", " + e.lng() + "change circle");
                this.parameters.center.lat = e.lat();
                this.parameters.center.lng = e.lng();
                // this.parameters.position.lat = e.lat;
                // this.parameters.position.lng = e.lng;
                this.parameters.position.lat = parseFloat(e.lat());
                this.parameters.position.lng = parseFloat(e.lng());
            },
            radiusChanged(radius) {
                this.parameters.radius = radius;

                // console.log(radius)
            },
            sendGeoData() {
                axios.post('/updtgeo', {
                    lat: this.parameters.center.lat,
                    lng: this.parameters.center.lng,
                    radius: Math.ceil(this.parameters.radius / 1000),
                    keyword: this.keyword
                }).then(respond => {
                    console.log(respond.data);
                });
                axios.post('/updadmin');
            },
            getGeoData() {
                axios.post('/getgeo').then(respond => {
                    console.log(respond.data);
                    this.parameters.center.lat = respond.data.latitude;
                    this.parameters.center.lng = respond.data.longtitude;
                    this.parameters.position.lat = respond.data.latitude;
                    this.parameters.position.lng = respond.data.longtitude;
                    this.parameters.mapCenter.lat = respond.data.latitude;
                    this.parameters.mapCenter.lng = respond.data.longtitude;
                    this.parameters.radius = respond.data.radius * 1000;
                    this.keyword = respond.data.keyword;
                })
            },
            transform(e) {
                this.parameters.radius = e.target.valueAsNumber * 1000;
                console.log(e.target.valueAsNumber);
            },
            checkedRoot() {
                axios.get('/auth/user').then(respond => {
                    if(respond.data.admin===0){
                        this.$router.push('usertable')
                    }
                });
            }
        },
        mounted: function () {
            this.checkedRoot();
            this.$nextTick(this.getGeoData);
        }
    }


</script>

<style scoped>
    .form {
        padding-bottom: 20px;
    }

    .vue-map-container {
        width: 725px;
        height: 400px;
        margin: 0 auto;
    }

    button {
        /*position: absolute ;*/
        /*right: 5px;*/
    }

</style>