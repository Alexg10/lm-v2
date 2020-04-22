<template>
    <section v-if="bloc" class="color-section" v-bind:style='{backgroundColor: bloc.color}'>
        <div class="container">
            <div class="color-section-container">
                <div class="color-container" v-for="color in bloc.blocColorsColor" v-bind:key>
                    <div class="color" v-bind:style="{background: color.colorHexa}"></div>
                    <div class="color-name">
                        {{color.colorTitle}} - {{color.colorHexa}}
                    </div>
                </div>
            </div>
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
                const blocColorsTimeline = new TimelineMax({ paused: false});

                blocColorsTimeline.staggerFromTo(".color-container", 2, {y: 80, opacity:0},{y: 0, opacity:1, ease: Power4.easeInOut, overwrite: false}, 0.35);

                this.timelines = {
                    colors: blocColorsTimeline
                }
            },
            createScenes(){
                this.scenes = [
                    this.$scrollmagic.scene({
                        triggerElement: this.$el,
                        triggerHook: 0.65,
                        offset: -200
                    })
                    .reverse(false)
                    .setTween(this.timelines.colors)
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
    .color-section{
        padding: 90px 0 110px;
        .color-section-container{
            display: flex;
            justify-content: center;
            .color-container{
                padding: 0 62px;
                text-align: center;
            }
        }
        .color{
            width: 80px;
            height: 80px;
            margin: 0 auto;
            margin-bottom: 25px;
            border-radius: 100px;
        }
        .color-name{
            font-family: 'GTWalsheimProRegular';
        }
        @media only screen and ( max-width : 768px ) {
            .color-section-container{
                flex-wrap: wrap;
                overflow: hidden;
                .color-container{
                    padding: 0 22px;
                    margin-bottom: 30px;
                }
            }
        }
        @media only screen and ( max-width : 680px ) {
            padding: 60px 0 50px;

        }
    }
</style>