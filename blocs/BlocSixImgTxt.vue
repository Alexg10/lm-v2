<template>
    <section v-if="bloc" class="img-square">
        <div class="container">
            <div class="img-square-container">
                <div class="project-chapter"><span class="number">{{bloc.chapter}}</span></div>
                <div class="project-category"><span class="name">{{bloc.chapterName}}</span></div>
                <div class="img-square-txt mobile">
                    {{bloc.blocSixTxt}}
                </div>
                <div class="img-square-section-container">
                    <div class="img-square-section-content" v-for="(image, index) in bloc.blocSixImages" v-bind:key>
                        <div v-if="index==4" class="img-square-txt">
                            {{bloc.blocSixTxt}}
                        </div>
                        <img :src="image.blocSixImg.sourceUrl" :alt="image.blocSixImg.title">
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
                const chapterTimeline = new TimelineMax({ paused: true});
                chapterTimeline
                    .fromTo(".img-square-container .number", 1, {y: 10},{y: 0, ease: Power4.easeInOut, overwrite: false})
                    .fromTo(".img-square-container .name", 1, {y: 40},{y: 0, ease: Power4.easeInOut, overwrite: false});
                
                const blocSixTimeline = new TimelineMax({ paused: false});
                blocSixTimeline.staggerFromTo(".img-square-section-content img", 1.5, {y: 140, opacity:0},{y: 0, opacity:1, ease: Power4.easeInOut, overwrite: false},0.3);

                this.timelines = {
                    chapter: chapterTimeline,
                    six    : blocSixTimeline
                }
            },
            createScenes(){
                this.scenes = [
                    this.$scrollmagic.scene({
                        triggerElement: ".img-square-container",
                        triggerHook: 0.65,
                        offset: 100
                    })
                    .reverse(false)
                    .setTween(this.timelines.chapter),

                    this.$scrollmagic.scene({
                        triggerElement: ".img-square-container",
                        triggerHook: 0.65,
                        offset: -100
                    })
                    .setTween(this.timelines.six)
                    .reverse(false)
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

    .project-chapter{
        font-family: 'GTWalsheimProBold';
        text-transform: uppercase;
        letter-spacing: 2px;
        //TODO : VAR
        // color: $grey;
        color: #B4B3B1;
        font-weight: bold;
        margin-bottom: 10px;
        overflow: hidden;
    }
    .project-category{
        font-family: 'GTWalsheimProBold';
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: bold;
        overflow: hidden;
    }
    .img-square{
        position: relative;
        padding-top: 100px;
        padding-bottom: 70px;
        //TODO : VAR
        // background-color: $light-grey;
        background-color: #F7F6F5;
        &:after{
            content:'';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100vw;
            height: 32%;
            //TODO : VAR
            // background-color: $white;
            background-color: #fff;
            z-index: 0;
        }
    }
    .img-square-container{
        text-align: center; 
    }
    .img-square-txt{
        font-size: 28px;
        text-align: center;
        max-width: 475px;
        margin: 0 auto;
        font-weight: bold;
        margin: 110px 0 100px;
    }
    .img-square-section-container{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        .img-square-section-content{
            position: relative;
            width: 33.3%;
            z-index: 10;
            &:nth-child(2){
                margin-top: 94px;
            }
        }
    }
    .img-square-txt.mobile{
        display: none;
    }

    @media ( max-width : 768px ) {
        .img-square-txt.mobile{
            display: block;
            margin: 70px auto;
        }
        .img-square-txt{
            font-size: 22px;
            display: none;
        }
        .img-square-section-container{
            .img-square-section-content{
                width: 50%;
                margin-bottom: 50px;
                &:nth-child(2){
                    margin-top: 0;
                }
            }
        }
    }
    @media ( max-width : 680px ) {
        .img-square-section-container{
            .img-square-section-content{
                width: 100%;
            }
        }
        .img-square-txt{
            font-size: 18px;
            padding: 0 20px;
        }
    }
</style>