<template>
    <section v-if="bloc" class="bloc-animation">
        <div class="container">
            <div class="bloc-animation-desktop-container">
                <img class="bloc-animation-desktop-img" :src="bloc.imageDesktop.sourceUrl">
            </div>
            <div class="anim-container">
                <div id="animation-hand" class="hand-anim"></div>
                <div id="animation-smart" class="hand-anim"></div>
                <div id="animation-accessibility" class="hand-anim"></div>
                <div id="animation-creativ" class="hand-anim"></div>
            </div>
            <div class="bloc-animation-mobile-container">
                <img class="bloc-animation-mobile-img" :src="bloc.imageMobile.sourceUrl">
            </div>
        </div>
    </section>
</template>

<script>
    import gsap from 'gsap'
    import lottie from 'lottie-web'

    export default {
        props: [
            'bloc'
        ],
        mounted(){
            lottie.loadAnimation({
                container: document.getElementById('animation-hand'),
                renderer : 'svg',
                loop     : true,
                autoplay : true,
                path     : "/images/anim_img/anim-hand-human.json"
            });
            lottie.loadAnimation({
                container: document.getElementById('animation-accessibility'),
                renderer : 'svg',
                loop     : true,
                autoplay : true,
                path     : "/images/anim_img/anim-hand-accessible.json"
            });
            lottie.loadAnimation({
                container: document.getElementById('animation-smart'),
                renderer : 'svg',
                loop     : true,
                autoplay : true,
                path     : "/images/anim_img/anim-hand-smart.json"
            });
            lottie.loadAnimation({
                container: document.getElementById('animation-creativ'),
                renderer : 'svg',
                loop     : true,
                autoplay : true,
                path     : "/images/anim_img/anim-hand-creativ.json"
            });

            var scrollM = this.$scrollmagic;
            var blocsAnim = document.getElementsByClassName("bloc-animation");

            Array.prototype.forEach.call(blocsAnim,function(el, i) {
                var tl         = new TimelineMax({ paused: false});
                var tlPara     = new TimelineMax({ paused: false});
                var animImg    = el.getElementsByClassName("bloc-animation-desktop-img");
                var animImgMob = el.getElementsByClassName("bloc-animation-mobile-img");

                tl.fromTo(animImg, 2, {yPercent: 10, opacity:0},{yPercent: 0, opacity:1, ease: Power4.easeInOut, overwrite: false},  "start")
                .fromTo(animImgMob, 2, {yPercent: 50, opacity:0},{yPercent: 0, opacity:1, ease: Power4.easeInOut, overwrite: false},  "start=+0.5")
                .staggerFromTo('.hand-anim', 2, {y: 40},{y: 0, ease: Power4.easeInOut, stagger:0.2},  "start+=");  
                
                tlPara.fromTo(animImgMob, 2, {y: 500},{y: -30, overwrite: false}, "start");                

                const animSectionScene = scrollM.scene({
                    triggerElement: el,
                    triggerHook: 0.7,
                    offset: -200
                })
                .setTween(tl)
                .reverse(false)
                // .addIndicators({ name: 'AnimeSection' })
                scrollM.addScene(animSectionScene)

                const animSectionScenePara = scrollM.scene({
                    triggerElement: el,
                    triggerHook: 0.65,
                    offset: -80,
                    duration: window.innerHeight*2
                })
                .setTween(tlPara)
                // .addIndicators({ name: 'AnimeSection' })
                scrollM.addScene(animSectionScenePara);
            });
        }
    }
</script>

<style lang="scss" scoped>
    .bloc-animation{
        // background: $white;
        background-color: #fff;
        position: relative;
        .container{
            width: 100%;
        }
        .bloc-animation-desktop-container{
            text-align: right;
            // overflow: hidden;
            .bloc-animation-desktop-img{
                width: 100%;
                max-width: 1050px;
            }
        }
        .bloc-animation-mobile-container{
            position: relative;
            display: inline-block;
            position: absolute;
            bottom: 0;
            z-index: 9;
            // margin-top: -153px;
        }
        .anim-container{
            display: flex;
            width: 45%;
            position: relative;
            left: 35%;
            top: -20px;
            justify-content: space-between;
            .hand-anim{
                flex: 1;
                padding: 0 10px;
                svg{
                    width: 70%!important;
                }
            }
            #animation-hand{
                max-width: 130px;
            }
            #animation-accessibility{
                max-width: 60px;
            }
            #animation-smart{
                max-width: 100px;
            }
            #animation-creativ{
                max-width: 80px;
            }
        }
        @media ( max-width : 780px ) {
            .bloc-animation-mobile-container{
                margin-top: -83px;
                left: 20px;
            }
            .anim-container{
                .hand-anim{
                    flex: 1;
                    padding: 0 10px;
                }
                #animation-accessibility{
                    max-width: 70px;
                }
                #animation-smart{
                    max-width: 90px;
                }
                #animation-creativ{
                    max-width: 90px;
                }
            }
        }
        @media ( max-width : 680px ) {
            .bloc-animation-mobile-container{
                width: 40%;
                margin-top: 57px;
                img{
                    width: 100%;
                }
            }
            .anim-container{
                display: flex;
                width: 50%;
                position: absolute;
                left: 50%;
                top: 290px;
                right: 50px;
                flex-wrap: wrap;
                .hand-anim{
                    width: 50%;
                    flex: initial;
                }
            }
        }
    }
</style>