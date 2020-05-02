<template>
    <div v-if="bloc" v-bind:style='{backgroundColor: bloc.color}'>
        <section v-if="bloc.pictureVideo === 'picture'" class="project-laptop-preview container">
            <div class="computer-content">
                <img class="laptop-svg" src="~/assets/images/block/laptop.svg" alt="">
                <img class="laptop-content" :src="bloc.laptopPicture.sourceUrl" alt="">
            </div>
        </section>
        <section v-if="bloc.pictureVideo === 'video'" class="project-laptop-preview container">
            <div class="computer-content">
                <img class="laptop-svg" src="~/assets/images/block/laptop.svg" alt="">
                <video class="laptop-content project-laptop-preview-video" loop muted autoplay>
                    <source :src="bloc.laptopVideo" type="video/mp4">
                </video>
            </div>
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
                const laptopTImeline = new TimelineMax({ paused: false});
                const img            = document.getElementsByClassName("project-laptop-preview");
                const video          = document.querySelector('.project-laptop-preview-video');

                laptopTImeline
                    .fromTo(img, 2.5, {y: 100, opacity: 0},{y: 0, opacity: 1, ease: Power4.easeInOut, overwrite: false});        

                this.timelines = {
                    laptop: laptopTImeline
                }
            },
            createScenes(){
                this.scenes = [
                    this.$scrollmagic.scene({
                        triggerElement: ".project-laptop-preview",
                        triggerHook: 0.65,
                        offset: -250
                    })
                    .reverse(false)
                    .setTween(this.timelines.laptop)
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
    .project-laptop-preview{
        text-align: center;
        img{
            width: 100%;
        }
        .project-laptop-preview-video{
            width: 100%;
        }
        .computer-content{
            position: relative;
            .laptop-content{
                position: absolute;
                top: 31px;
                left: 50%;
                width: 64%;
                transform: translateX(-50%);
            }

        }
        @media ( max-width : 780px ) {
            padding: 0 20px;
            text-align: center;
            img{
                width: 100%;
            }
        }
        @media ( max-width : 680px ) {

        }
    }
</style>