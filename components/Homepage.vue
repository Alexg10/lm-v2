<template>
        <div class="homepage-container">
            <div class="swiper-slide love-container">
                <div class="home-slide-content red">
                    <div class="bg-love"></div>
                    <div class="word-container" v-on:mouseenter="loveHover" v-on:mouseleave="loveLeave" v-on:click="loveClick">
                        <div class="word elle">
                            <span class="hide">
                                <div class="hide-right">el</div>
                            </span>
                            <span class="hide">l</span>
                            <span class="hide">
                                <div class="hide-left">e</div>
                            </span>
                        </div>
                        <div class="word aime">
                            <span class="hide">
                                <div class="hide-right">ai</div>
                            </span>
                            <span class="hide">m</span>
                            <span class="hide">
                                <div class="hide-left">e</div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide work-container">
                <div class="home-slide-content orange">
                    <nuxt-link to="project">
                        <div class="word-container" v-on:click="workClick">
                            <span class="word work">work</span>
                            <span class="word work">work</span>
                            <span class="word work">work</span>
                        </div>
                    </nuxt-link>
                </div>
            </div>
        </div>
</template>

<script>
    import gsap from "gsap"

    export default {
        data(){
            return{
                LoveClickTl : gsap.timeline({paused: true}),
                workClickTl : gsap.timeline({paused: true}),
            }
        },

        methods: {
            scrollSlide(){
                const work = document.querySelector('.work-container');
                var vm = this;
                var scrollable = true;
                window.addEventListener('wheel', function(e) {
                    if (e.deltaY < 0 && scrollable) {
                        scrollable = false;
                        console.log('up');
                        // vm.$refs.slick.prev();
                        if( !work.classList.contains('visible') ){
                            work.classList.add("visible");
                        }else{
                            work.classList.remove("visible");
                        }
                        setTimeout(() => {
                            scrollable = true;
                        }, 1500);
                    }
                    if (e.deltaY > 0 && scrollable) {
                        console.log('down');
                        scrollable = false;
                        // vm.$refs.slick.next();
                        if( work.classList.contains('visible') ){
                            work.classList.remove("visible");
                        }else{
                            work.classList.add("visible");
                        }
                        setTimeout(() => {
                            scrollable = true;
                        }, 1500);
                    }
                });
            },
            loveHover(){
                document.querySelector('.bg-love').classList.add("visible");
            },
            loveLeave(){
                document.querySelector('.bg-love').classList.remove("visible");
            },
            loveClick(){
                this.LoveClickTl.play()
            },
            workClick(){
                var vm=this;
                this.workClickTl.play();
                this.workClickTl.eventCallback("onComplete", function () {
                    vm.$router.push({
                        path: '/project/'
                    })
                });

            }
        },
        mounted() {
            this.LoveClickTl.to(".elle", {x: "-80vw", duration: 1, ease: "power4.in"}, "fire")
                            .to(".aime", {x: "80vw", duration: 1, ease: "power4.in"}, "fire");

            this.workClickTl.to(".work:nth-child(1)", {x: "80vw", duration: 1, ease: "power4.in"}, "fire")
                            .to(".work:nth-child(2)", {x: "-80vw", duration: 1, ease: "power4.in"}, "fire+=0.1")
                            .to(".work:nth-child(3)", {x: "80vw", duration: 1, ease: "power4.in"}, "fire+=0.2");
            
            this.scrollSlide();
        }
    }
</script>

<style lang="scss" scoped>

    body{
        overflow: hidden;
    }
    .homepage-container{
        position: relative;
        overflow: hidden;
        .work-container{
            position: absolute;
            top: 0;
            left: 0;
            display: none;
            &.visible{
                display: block;
            }
        }
    }
    a{
        text-decoration: none;
        color: black;
        transition: all 0.6s ease;
    }
    .swiper-container{
        height: 100vh;
    }
    .swiper-slide{
        width: 100vw;
        // height: 100%!important;
    }
    .bg-love{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: green;
        opacity: 0;
        transition: all 0.9s cubic-bezier(.19,.77,.2,1);
        &.visible{
            opacity: 1;
            transition: all 0.9s cubic-bezier(.19,.77,.2,1);
        }
    }
    .home-slide-content{
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-size: 200px;
        text-align: center;
        font-weight: bold;
        &.red{
            background-color: red;
        }
        &.orange{
            background-color: orange;
        }

        .word-container{
            display: block;
            &:hover{
                cursor: pointer;
                .word,
                a{
                    color: #FF9170;
                    transition: all 0.9s cubic-bezier(.19,.77,.2,1);
                }
                .hide{
                    color: #FF9170;
                    transition: all 0.9s cubic-bezier(.19,.77,.2,1);
                    .hide-right,
                    .hide-left{
                        color: #FF9170;
                        transform: translateX(0);
                        opacity: 1;
                        transition: all 0.9s cubic-bezier(.19,.77,.2,1);
                    }
                }
                //ELLE AIME
                .elle{
                    color: #FF9170;
                    left: -79px;
                    transition: all 0.9s cubic-bezier(.19,.77,.2,1);
                }
                .aime{
                    color: #FF9170;
                    left: 125px;
                    transition: all 0.9s cubic-bezier(.19,.77,.2,1);
                }

                //WORK
                .work{
                    transition: all 1.05s cubic-bezier(.19,.77,.2,1);
                    &:nth-child(1){
                        position: relative;
                        left: 107px;
                    }
                    &:nth-child(2){
                        position: relative;
                        left: -22px;
                    }
                    &:nth-child(3){
                        position: relative;
                        left: 182px;
                    }
                }
            }
            .word{
                display: flex;
                line-height: 160px;
                color: black;
                transition: all 1.1s cubic-bezier(.19,.77,.2,1);
            }
            .hide{
                width: auto;
                overflow: hidden;
                display: inline-block;
                color: black;
                transition: all 1.1s cubic-bezier(.19,.77,.2,1);
                .hide-right{
                    color: black;
                    transform: translateX(100%);
                    opacity: 0.3;
                    transition: all 1.1s cubic-bezier(.19,.77,.2,1);
                }
                .hide-left{
                    color: black;
                    transform: translateX(-100%);
                    opacity: 0.3;
                    transition: all 1.1s cubic-bezier(.19,.77,.2,1);
                }
            }
            //ELLE AIME
            .elle{
                position: relative;
                bottom: -38px;
                left: 3px;
                transition: all 1.1s cubic-bezier(.19,.77,.2,1);
            }
            .aime{
                position: relative;
                top: -39px;
                left: 45px;
                transition: all 1.1s cubic-bezier(.19,.77,.2,1);
            }
            //WORK
            .work{
                transition: all 1.1s cubic-bezier(.19,.77,.2,1);
                &:nth-child(1){
                    position: relative;
                    bottom: -77px;
                    left: 27px;
                }
                &:nth-child(2){
                    position: relative;
                    left: 155px;
                }
                &:nth-child(3){
                    position: relative;
                    top: -73px;
                    left: -79px;
                }
            }
        }

    }

</style>