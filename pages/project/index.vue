<template>
    <div class="list-container">
        <!-- <div class="project-cover">
            <img src="http://localhost:8888/lm/lm_wordpress/wp-content/uploads/2019/11/diskocover-600x337.png" alt="">
        </div> -->
        <div v-if="projects"  class="project-list">
            <slick-slide ref="slick" :options="slickOptions" class="home-slider"  >
                <div v-for="project in projects" class="project-slide" :key="project.id" @click="clickSlide">
                    <div class="slide-link">
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
                    speed: 1200,
                    infinite: true,
                    centerMode: true,
                    arrows: false,
                    cssEase: 'cubic-bezier(.19,.77,.2,1)'
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
                // var slideActive = document.getElementsByClassName('swiper-slide-active')[0].children[0].getElementsByClassName("slide-container");
                // var introTl = gsap.timeline({delay: 0.75})
                // introTl.add('start');
                // introTl.to( ".swiper-slide", {opacity: 1, duration: 3, ease: "power4.inOut"},'animIntroStart')
                //     .from( slideActive, {width:"100vw", height:"100vh", duration: 4, ease: "power4.out"},'animIntroStart+=3')
                //     .from( ".slide-background", {scale: 1, duration: 4, ease: "power4.out"},'animIntroStart+=3')
                //     .from( ".swiper-slide-prev", {x: "-20vw", duration: 0.8}, 'animIntroStart+=5.5')
                //     .from( ".swiper-slide-next", {x: "20vw", duration: 0.8}, 'animIntroStart+=5.5')
                //     .from( ".swiper-slide-active .project-name", {top: 210, duration: 0.6}, 'animIntroStart+=6.2');
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
            keySlide(e) {
                var vm = this;
                document.onkeydown = function(e){
                    e = e || window.event;
                    if (e.keyCode == '38') {
                        vm.$refs.slick.prev();
                    }
                    else if (e.keyCode == '40') {
                        vm.$refs.slick.next();

                    }
                    else if (e.keyCode == '37') {
                        vm.$refs.slick.prev();

                    }
                    else if (e.keyCode == '39') {
                        vm.$refs.slick.next();

                    }
                }
            },
            clickSlide(elem){
                var vm = this;
                console.log(this);
                console.log(elem);

                // var slide = document.querySelector('.slick-slide');
                // currentIndex = document.querySelector('.slick-slide').dataset.slick-index;
                // console.log(currentIndex)

                // var index = this.dataset.slick-index;
                // console.log(index);
                // if(index < currentIndex){
                //     vm.$refs.slick.prev();
                // }else if(index > currentIndex){
                //     vm.$refs.slick.next();
                // }else{
                //     goToProject();
                // }
            }
        },
        mounted() {
            // this.animIntro();
            this.scrollSlide();
            this.keySlide();
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
        max-width: 540px;
        overflow: hidden;
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
        max-width: 630px;
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
        .project-slide{
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
    }

    .project-infos{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 99;
    }
    .slide-layer{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #FF9170;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.5s ease;
    }

</style>