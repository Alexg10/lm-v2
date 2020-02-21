<template>
    <div class="list-container">
        <div class="project-cover">
            <img src="http://localhost:8888/lm/lm_wordpress/wp-content/uploads/2019/11/diskocover-600x337.png" alt="">
        </div>
        <div v-if="projects"  class="project-list">
            <slick-slide ref="slick" :options="slickOptions" class="home-slider">
                <div v-for="project in projects" class="project-slide" :key="project.id">
                    <div class="slide-link" @click="animOutro">
                        <div class="project-infos">
                            <div class="project-name-container">
                                <div class="project-name">{{project.acfProjectFields.projectTitle}}</div>
                            </div>
                            <div class="project-type-container">
                                <div class="project-type">{{project.acfProjectFields.projectType}}</div>
                            </div>
                        </div>
                        <div class="slide-container">
                            <img :src="project.acfProjectFields.headerPicture.sourceUrl" alt="" class="slide-img">
                            <div class="slide-layer"></div>
                        </div>
                    </div>
                </div> 
            </slick-slide>
        </div>
    </div>

</template>

<script>

    import gsap from "gsap"
    import projects from '~/queries/projects'

    export default {
        transition: 'listFade',
        data(){
            return{
                slickOptions: {
                    slidesToShow: 1,
                    infinite: true,
                    centerMode: true,
                    arrows: false
                }
            }
        },
        apollo: {
            projects : {
                prefetch : true,
                query : projects,
                update: (data) => data.projects.nodes
            }
        },
        methods: {
            animIntro(){
                var slideActive = document.getElementsByClassName('swiper-slide-active')[0].children[0].getElementsByClassName("slide-container");
                var introTl = gsap.timeline({delay: 0.75})
                introTl.add('start');
                introTl.to( ".swiper-slide", {opacity: 1, duration: 3, ease: "power4.inOut"},'animIntroStart')
                    .from( slideActive, {width:"100vw", height:"100vh", duration: 4, ease: "power4.out"},'animIntroStart+=3')
                    .from( ".slide-background", {scale: 1, duration: 4, ease: "power4.out"},'animIntroStart+=3')
                    .from( ".swiper-slide-prev", {x: "-20vw", duration: 0.8}, 'animIntroStart+=5.5')
                    .from( ".swiper-slide-next", {x: "20vw", duration: 0.8}, 'animIntroStart+=5.5')
                    .from( ".swiper-slide-active .project-name", {top: 210, duration: 0.6}, 'animIntroStart+=6.2');
            },
            animOutro(){
                // var slideActive = document.getElementsByClassName('swiper-slide-active')[0].children[0].getElementsByClassName("slide-container");
                // var outroTl = gsap.timeline({delay: 0.75})
                // outroTl.add('start');
                // outroTl
                //     .to( ".swiper-slide-prev", {x: "-20vw", duration: 0.8}, 'animOutroStart')
                //     .to( ".swiper-slide-next", {x: "20vw", duration: 0.8}, 'animOutroStart')
                //     .to( ".slide-layer", {opacity: 0, duration: 0.8}, 'animOutroStart+=0.6')
                //     .to( ".slide-background", {scale: 1, duration: 2, ease: "power4.out"}, 'fire')
                //     .to( slideActive, {width:"100vw", height:"100vh", duration: 2, ease: "power4.out"},'fire')
            },
            scrollSlide(){
                var vm = this;
                var scrollable = true;
                window.addEventListener('wheel', function(e) {
                    if (e.deltaY < 0 && scrollable) {
                        scrollable = false;
                        console.log('up');
                        vm.$refs.slick.prev();
                        setTimeout(() => {
                            scrollable = true;
                        }, 1000);
                    }
                    if (e.deltaY > 0 && scrollable) {
                        console.log('down');
                        scrollable = false;
                        vm.$refs.slick.next();
                        setTimeout(() => {
                            scrollable = true;
                        }, 1000);
                    }
                });
            },
        },
        mounted() {
            // this.animIntro();
            this.scrollSlide();
        },
    }
</script>

<style lang="scss" scoped>
    .list-container{
        overflow: hidden;
        width: 100vw;
        height: 100vh;
    }
    .project-cover{
        position: relative;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        object-fit: cover;
        img{
            position: absolute;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            top: 0;
            left: 0;
            height: 100vh;
            object-fit: cover;
        }
    }
    .project-slide{
        position: relative;
        height: auto;
        align-self: center;
        overflow: visible;
        display: block;
        height: 100%;
        transition: all 1.1s cubic-bezier(.19,.77,.2,1);
    }
    .project-name-container,
    .project-type-container{
        overflow: hidden;
    }

    .project-list{
        width: 50%;
        margin: 0 auto;
        .slide-img{
            position: absolute;
            top: 0;
            left: 50%;
            height: 100vh;
            object-fit: cover;
            transform: translate(-50%, -12%);
        }
    }

    .project-name{
        position: relative;
        display: inline-block;
        text-decoration: none;      
        white-space: nowrap;  
        font-size: 200px;
        text-decoration: none;     
        transform: translateY(210px);
        color: #FF9170;
        opacity: 0.3;
        transition: all 0.5s ease;
        z-index: 101;
    }
    .project-type{
        color: white;
        font-size: 16px;
        font-family: 'GTWalsheimProBold';
        text-transform: uppercase;
        letter-spacing: 1px;
        transform: translateY(50px);
        transition: 0.5s ease-in-out;
        pointer-events: none;
        text-align: center;
    }

    .slick-slide{
        overflow: hidden;
        margin: 0 20%;
    }

    //SWIPE ACTIVE
    .slick-active{
        .slide-container{
            z-index: 99;
        }
        .project-infos{
            z-index: 101;
        }
        .project-name{
            transform: translateY(0);
            opacity: 0.3;
            transition: color 0.5s ease, opacity 0.5s ease, transform 5s ease;
            transition-delay: 1s;
            transition-property: transform;
        }
        &:hover{
            .project-name{
                opacity: 1;
                transition: all 0.5s ease;
            }
            .slide-layer{
                opacity: 0.4;
                transition: opacity 0.5s ease;
            }
            .project-type{
                transform: translateY(0);
                transition: transform 0.4s ease;
            }
        }
    }
    // //SWIPE NEXT
    // .swiper-slide-next,
    // .swiper-slide-duplicate-next{
    //     transform: translateX(0px);
    //     transition: all 0.5s ease;
    //     pointer-events: none;
    //     &:hover{
    //         transform: translateX(-30px);
    //         transition: all 0.6s ease;
    //     }
    // }
    // //SWIPE PREV
    // .swiper-slide-prev,
    // .swiper-slide-duplicate-prev{
    //     transform: translateX(0);
    //     transition: all 0.5s ease;
    //     pointer-events: none;
    //     &:hover{
    //         transform: translateX(30px);
    //         transition: all 0.6s ease;
    //     }
    // }
    // .swiper-button-prev,
    // .swiper-button-next{
    //     top: 0;
    //     width: 22%;
    //     height: 100%;
    //     margin-top: 0;
    //     right: 0!important;
    //     opacity: 0;
    //     z-index: 10;
    // }
    // .swiper-button-prev{
    //     right: auto!important;
    //     left: 0!important;
    // }

    .project-infos{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 99;
    }
    // .slide-container{
    //     text-decoration: none;
    //     height: 70vh;
    //     width: 560px;
    //     display: block;
    //     overflow: hidden;
    //     position: absolute;
    //     top: 50%;
    //     left: 50%;
    //     transform: translate(-50%, -50%);
    // }
    // .slide-background{
    //     position: absolute;
    //     display: flex;
    //     flex-direction: column;
    //     justify-content: center;
    //     align-items: center;
    //     height: 100vh;
    //     // max-height: 70vh;
    //     width: 560px;
    //     background-size: cover;
    //     top: 50%;
    //     left: 50%;
    //     width: 100vw;
    //     height: 100vh;
    //     z-index: 99;
    //     transform: translate(-50%, -50%) scale(0.8);
    //     // transform: translate(-50%, -50%);

    //     .slide-layer{
    //         position: absolute;
    //         top: 0;
    //         left: 0;
    //         width: 100%;
    //         height: 100%;
    //         background-color: #FF9170;
    //         opacity: 0;
    //         transition: opacity 0.5s ease;
    //     }
    // }

</style>