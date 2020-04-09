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
            }
        },
        props: [
            'bloc'
        ],
        mounted() {
                var scrollM = this.$scrollmagic;
                var tl= new TimelineMax({ paused: false});

                var imgContain = document.getElementsByClassName("img-container");
                var imgContainEl = document.getElementsByClassName("img-container")[0];

                tl.fromTo(".img-section .container", 2, {y: 40, opacity: 0}, {y: 0, opacity: 1, ease: Power4.easeInOut, overwrite: false});                
                const imgSectionScene = scrollM.scene({
                    triggerElement: ".img-section ",
                    triggerHook: 0.65,
                    offset: -50
                })
                .setTween(tl)
                .reverse(false)
                // .addIndicators({ name: '2 (imgCain00)' })
                scrollM.addScene(imgSectionScene)

                var img1 = document.querySelector(".img-section-container:nth-child(1) .img-container img");
                var img2 = document.querySelector(".img-section-container:nth-child(2) .img-container img");
                var img3 = document.querySelector(".img-section-container:nth-child(3) .img-container img");

                if(!this.$device.mobile){

                    var sectionTl= new TimelineMax({ paused: false});
                    var scrollB = this.$scrollmagic;

                    const sceneHalfSection = scrollB.scene({
                        triggerElement: ".img-section",
                        triggerHook: 0.65,
                        offset: -150,
                        duration: window.innerHeight*2.5
                    })
                    .setTween(sectionTl)
                    scrollB.addScene(sceneHalfSection);

                    sectionTl.fromTo(img1, 1, {y: 0},{y: 300, overwrite: false},"start")
                    .fromTo(img2, 1, {y: 0},{y: -80, overwrite: false}, "start")
                    .fromTo(img3, 1, {y: 0},{y: -100, overwrite: false}, "start");
                }


        },
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