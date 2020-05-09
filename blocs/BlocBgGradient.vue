<template>
    <section v-if="bloc" class="gradient-bg">
        <div class="gradient-column" v-for="image in bloc.gradientBackground" :data-length="bloc.gradientBackground.length"  v-bind:key :style="{ backgroundImage: `url('${image.gradientBackgroundImage.sourceUrl}')` }"></div>
        <div class="text">
            <p>{{bloc.blocBgGradientTxt}}</p>
        </div>
    </section>
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
                // blocStep timeline
                const blocGradientTimeline    = new TimelineMax({ paused: false});

                var column1 = document.querySelector(".gradient-bg .gradient-column:nth-child(1)");
                var column2 = document.querySelector(".gradient-bg .gradient-column:nth-child(2)");
                var column3 = document.querySelector(".gradient-bg .gradient-column:nth-child(3)");
                var column4 = document.querySelector(".gradient-bg .gradient-column:nth-child(4)");
                var column5 = document.querySelector(".gradient-bg .gradient-column:nth-child(5)");
                var column6 = document.querySelector(".gradient-bg .gradient-column:nth-child(6)");

                blocGradientTimeline
                    .fromTo(column1, 1, {y: -42},{y: 42, overwrite: false},"start")
                    .fromTo(column2, 1, {y: -8},{y: 8, overwrite: false}, "start")
                    .fromTo(column3, 1, {y: -28},{y: 28, overwrite: false}, "start")
                    .fromTo(column4, 1, {y: -72},{y: 72, overwrite: false}, "start")
                    .fromTo(column5, 1, {y: -38},{y: 38, overwrite: false}, "start")
                    .fromTo(column6, 1, {y: 15},{y: -15, overwrite: false}, "start");


                this.timelines = {
                    gradients: blocGradientTimeline
                }
            },
            createScenes(){
                const gradientHeightDuration = document.querySelector(".gradient-bg").offsetHeight;

                this.scenes = [
                    this.$scrollmagic.scene({
                        triggerElement: this.$el,
                        triggerHook   : 0.65,
                        offset        : -180,
                        duration      : gradientHeightDuration+700
                    })
                    .reverse(true)
                    .setTween(this.timelines.gradients)
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
    .gradient-bg{
        display: flex;
        position: relative;
        border: none;
        margin-bottom: 40px;
        margin-top: 20px;
        z-index: 99;
        @media only screen and ( max-width : 680px ) {
            min-height: 500px;
            padding: 30px 0;
        }
        .gradient-column{
            flex:1;
            min-height: 740px;
            min-width: 16.666666667%;
            width: 16.666666667%;
            border-right: 1.5px solid rgba(227,225,225,0.33);
            @media only screen and ( max-width : 780px ) {
                min-width: 25%;
                width: 25%;
            }
            @media only screen and ( max-width : 680px ) {
                min-height: 400px;
            }
        }
    }
    .text{
        position: absolute;
        font-size: 28px;
        display: flex;
        justify-content: center;
        align-items: center;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        p{
            text-align: center;
            max-width: 640px;
            margin: 0 auto;
            font-weight: bold;
            //TODO : VAR
            // color: $whit:e;
            color: #FFF
        }
    }
    @media only screen and ( max-width : 680px ) {
        .text{
            width: 70%;
            font-size: 18px;
        }
        .gradient-bg{
            width: 100vw;
            overflow: hidden;
            .gradient-column{
                min-width: 170px;
                width: 170px;
                min-height: 482px;
            }
        }
    }
</style>