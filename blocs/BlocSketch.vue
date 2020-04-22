<template>
    <div v-if="bloc" v-bind:style='{backgroundColor: bloc.color}'>
        <section class="img-section">
            <div class="container">
                <div id="img-section-container" class="img-section-container" v-for="image in bloc.sketchImages" :key="bloc.id">
                    <div class="img-container grid-item">
                        <img :src="image.sketchImage.sourceUrl">
                    </div>
                </div>
            </div>
            <div class="spacer" style="clear: both;"></div>
        </section>
    </div>
</template>

<script>
    import gsap from 'gsap'

    export default {
        data(){
            return{
                timelines: {},
                scenes: []
            }
        },
        props: [
            'bloc'
        ],
        methods: {
            createTimelines(){
                const blocSketchTimeline = new TimelineMax({ paused: false});
                blocSketchTimeline.fromTo(".img-section .container", 2, {y: 40, opacity: 0}, {y: 0, opacity: 1, ease: Power4.easeInOut, overwrite: false});                

                // if(!this.$device.mobile){
                // }

                const blocSketchParallax = new TimelineMax({ paused: false});
                const img1 = document.querySelector(".img-section-container:nth-child(1) .img-container img");
                const img2 = document.querySelector(".img-section-container:nth-child(2) .img-container img");
                const img3 = document.querySelector(".img-section-container:nth-child(3) .img-container img");
                blocSketchParallax
                    .fromTo(img1, 1, {y: 0},{y: 300, overwrite: false},"start")
                    .fromTo(img2, 1, {y: 0},{y: -80, overwrite: false}, "start")
                    .fromTo(img3, 1, {y: 0},{y: -100, overwrite: false}, "start");

                this.timelines = {
                    sketch        : blocSketchTimeline,
                    sketchParallax: blocSketchParallax
                }
            },
            createScenes(){
                this.scenes = [
                    this.$scrollmagic.scene({
                        triggerElement: ".img-section",
                        triggerHook: 0.65,
                        offset: -50
                    })
                    .setTween(this.timelines.sketch)
                    .reverse(false),
                    this.$scrollmagic.scene({
                        triggerElement: ".img-section",
                        triggerHook: 0.65,
                        offset: -150,
                        duration: window.innerHeight*2.5
                    })
                    .setTween(this.timelines.sketchParallax)
                    .reverse(false),

                ]
            }
        },
        mounted() {
            // Create timelines and scenes
            this.createTimelines();
            this.createScenes();

            // Add scenes to controller
            this.$scrollmagic.addScene(this.scenes);
        },
        destroyed() {
            this.$scrollmagic.removeScene(this.scenes);
        }
    }
</script>

<style lang="scss" scoped>
    .img-section{
        // background-color: $white;
        background-color: #fff;
    }
    .container{
        @media only screen and ( max-width : 680px ) {
            display: flex;
            flex-direction: column;
        }
    }
    .img-section-container{
        display: inline-block;
        width: 50%;
        float: left;
        @media only screen and ( max-width : 680px ) {
            width: 100%;
            order: 2;
        }
        &:nth-child(2){
            margin-bottom: 60px;
            @media only screen and ( max-width : 680px ) {
                order: 1;
            }
            .img-container{
                max-width: 240px;
                margin: 0 auto;
            }
        }
        .img-container{
            width: 100%;
            img{
                width: 100%;
            }
        }
        .phone-container{
            text-align: center;
            padding: 100px 0;
        }
    }

</style>