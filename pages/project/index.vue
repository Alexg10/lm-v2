<template>
    <div class="list-container">
        <div v-if="projects" class="project-list">
            <div ref="cover" class="project-cover" >
                <img class="project-cover-img" :src="cover" alt="" ref="coverImg">
            </div>
            <slick-slide ref="slick" :options="slickOptions" class="home-slider" @afterChange="handleAfterChange" @beforeChange="handleBeforeChange" @init="handleInit">
                <div v-for="project in projects" class="project-slide" :key="project.id" @click="clickSlide" ref="slides">
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
                    centerPadding: '20%',
                    arrows: false,
                    cssEase: 'cubic-bezier(.19,.77,.2,1)',
                }
            }
        },
        computed: {
            cover(){
                return this.projects[0].acfProjectFields.headerPicture.sourceUrl;
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
            handleInit(event, slick){
                const current = slick.$slides[0];
                const prev    = current.previousSibling;
                const next    = current.nextSibling;


                var introTl = gsap.timeline({delay: 1})
                introTl.add('start');
                introTl.to( this.$refs.cover, {width: 507, duration: 3, ease: "power4.inOut"},'animIntroStart')
                    .to( this.$refs.cover, {height: 640, duration: 3, ease: "power4.inOut"},'animIntroStart=+0.5')
                    .to(this.$refs.coverImg, {scale: 1, x:"-50%", y:"-50%", duration: 3, ease: "power4.inOut"},'animIntroStart')
                    .from(prev, {x:'-20%', duration: 3, ease: "power4.inOut"},'animIntroStart=+3')
                    .from(next, {x:'20%', duration: 3, ease: "power4.inOut"},'animIntroStart=+3');


                introTl.eventCallback("onComplete", ()=> this.$refs.cover.style.display = "none");
            },
            handleAfterChange(){
                
            },
            handleBeforeChange(){

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
        position: fixed;
        top: 50%;
        left: 50%;
        width: 100vw;
        height: 100vh;
        z-index: 999;
        overflow: hidden;
        transform: translate(-50%,-50%);
        .project-cover-img{
            position: absolute;
            width: 100vw;
            height: 100vh;
            top: 50%;
            left: 50%;
            transform: scale(1.1) translate(-50%,-50%);
        }
    }
    .project-slide{
        position: relative;
        height: auto;
        align-self: center;
        overflow: visible;
        display: block;
        height: 100%;
        overflow: hidden;
        transition: all 1.1s cubic-bezier(.19,.77,.2,1);
        margin: 0 15%;
    }
    .project-name-container,
    .project-type-container{
        overflow: hidden;
    }

    .project-list{
        .slide-img{
            position: absolute;
            top: 50%;
            left: 50%;
            height: 100vh;

            width: 100vw;
            transform: translate(-50%, -50%);
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