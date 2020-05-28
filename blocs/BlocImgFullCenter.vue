<template>
    <section v-if="bloc" class="img-full-center-section">
        <div class="container">
            <div class="img-full-center-section-container">
                <img :src="bloc.blocImgFullCenterImg.sourceUrl" alt="">
            </div>
        </div>
    </section>
</template>

<script>
    import gsap from "gsap"
    
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
                const blocImgFullCenterTimeline = new TimelineMax({ paused: false});

                var img = this.$el.children[0].querySelector(".img-full-center-section-container img");
                blocImgFullCenterTimeline.fromTo(img, 2.5, {y: 50, opacity: 0},{y: 0, opacity: 1, ease: Power4.easeInOut, overwrite: false});                

                this.timelines = {
                    imgFullCenter: blocImgFullCenterTimeline
                }
            },
            createScenes(){
                this.scenes = [
                    this.$scrollmagic.scene({
                        triggerElement: this.$el,
                        triggerHook: 0.65,
                        offset: -250
                    })
                    .reverse(false)
                    .setTween(this.timelines.imgFullCenter)
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
    .img-full-center-section{
        position: relative;
        .img-full-center-section-container{
            position: relative;
            display: block;
            justify-content: center;
            z-index: 9;
            overflow: hidden;
            img{
                width: 100%;
            }
        }
    }
</style>