<template>
    <section v-if="bloc" class="img-4-section" v-bind:style='{backgroundColor: bloc.color}' >
        <div class="container">
            <div class="img-4-section-container" >
                <div :class="bloc.typo ? 'img-4-container grid-item typo': 'img-4-container grid-item'" v-for="four_image in bloc.blocFourSectionImg" v-bind:key>
                    <img class="img-4" :src="four_image.image.sourceUrl" :alt="four_image.image.title">
                </div>
            </div>
        </div>
    </section>
</template>

<script>
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
                const blocFourSectionTimeline = new TimelineMax({ paused: false});
                blocFourSectionTimeline.staggerFromTo(this.$el.getElementsByClassName("img-4"), 1.5, {y: 140, opacity:0},{y: 0, opacity:1, ease: Power4.easeInOut, overwrite: false}, 0.35);

                this.timelines = {
                    fourSection: blocFourSectionTimeline

                }
            },
            createScenes(){
                this.scenes = [
                    this.$scrollmagic.scene({
                        triggerElement: this.$el,
                        triggerHook: 0.65,
                        offset: -100
                    })
                    .reverse(false)
                    .setTween(this.timelines.fourSection)
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
    .img-4-section{
        padding: 90px 0 110px;
        .img-4-section-container{
            display: flex;
            .img-4-container{
                flex: 1;
                display: flex;
                justify-content: center;
                overflow: hidden;
            }
        }
        @media only screen and ( max-width : 768px ) {
            padding: 40px 0 0;
            .img-4-section-container{
                display: flex;
                overflow: hidden;
                flex-wrap: wrap;
                .img-4-container{
                    flex: 50%;
                    margin-bottom: 40px;
                    &.typo{
                        flex: 100%;
                        width: 100%;
                        margin-bottom: 60px;
                        &:last-of-type{
                            margin-bottom: 20px;
                        }
                        img{
                            width: 100%;
                        }
                    }
                }
            }
        }
        @media only screen and ( max-width : 680px ) {
            padding: 10px 0 0;
            .img-4-section-container{
                display: block;
                flex-wrap: wrap;
                .img-4-container{
                    flex: 50%;
                    margin-bottom: 30px;
                    min-height: 130px;
                    padding: 0 20px;
                    &.typo{
                        width: 100%;
                        margin-bottom: 60px;
                        &:last-of-type{
                            margin-bottom: 20px;
                        }
                        img{
                            width: 100%;
                        }
                    }
                    img{
                        width: 50%;
                    }
                }
            }
        }
    }
</style>