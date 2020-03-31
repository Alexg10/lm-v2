<template>
    <div class="project-header">
        <img class="bg-cover" :src="cover.sourceUrl" alt="">
        <div class="cross link-hover" v-on:click="goToList">
            <div class="crossLineOne">
                <div class="crossLineOne_content"></div>
            </div>
            <div class="crossLineTwo">
                <div class="crossLineTwo_content"></div>
            </div>
        </div>
        <div class="project-header-content">
            <div class="project-header-content-top">
                <div class="category">
                    <div class="category-type">{{type}}</div>
                </div>
                <div class="project-name">
                    <div class="project-name-content">{{title}}</div>
                </div>
            </div>
            <div class="project-description">
                <p>{{description}}</p>
                <div v-if="link" class="link-container" >
                    <a :href="link" target="_blank" class="project-link link link-hover link-stagger" rel="noopener" data-cursor-hover>View the website</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import gsap from "gsap"


    export default {

        props: [
            'title',
            'description',
            'type',
            'link',
            'cover'
        ],
        methods: {
            goToList(){
            var vm = this;

                var VueScrollTo = require('vue-scrollto');
                const scrollOptions = {
                    easing: 'ease-in',
                    force: true,
                    cancelable: false,
                    onDone: function(element) {
                        VueScrollTo.unbind(element);
                        vm.changeProject();
                    }
                }
                document.querySelector('.cross').classList.remove("active");
                VueScrollTo.scrollTo('.project-header', 800, scrollOptions);

            },
            detectScroll(){
                var lastScrollTop = 0;
                var winHeight = window.innerHeight;

                window.addEventListener("scroll", function(){ 
                    var st = window.pageYOffset || document.documentElement.scrollTop; 
                    if(st>winHeight){
                        document.querySelector('.cross').classList.remove("active");
                        document.querySelector('.cross').classList.add("fixed");
                    }else{
                        document.querySelector('.cross').classList.remove("active");
                        document.querySelector('.cross').classList.remove("fixed");
                    }
                    if (st < lastScrollTop){
                        document.querySelector('.cross').classList.add("active");
                    } 
                    lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
                }, false);
            },
            hoverAddClass(){
                var link = document.getElementsByClassName("link-hover");
                var hoverAddClassFunction = function() {
                    document.querySelector('.cursor-fx__inner__outside').classList.add('hover');
                    console.log('hoverlink');
                };
                var hoverRemoveClassFunction = function() {
                    document.querySelector('.cursor-fx__inner__outside').classList.remove('hover');
                    console.log('hoverlink');
                };

                for (var i = 0; i < link.length; i++) {
                    link[i].addEventListener('mouseenter', hoverAddClassFunction, false);
                    link[i].addEventListener('mouseleave', hoverRemoveClassFunction, false);
                }
            },
            changeProject() {
                // Set project to store
                // this.$store.commit('setCover', this.link);

                // Animate out
                this.$router.push({
                    path: `/project`
                })
            },
        },
        mounted() {
            var vm = this;
            this.hoverAddClass();
            this.detectScroll();
            var anim = gsap.timeline({});
            var sectionTl= new TimelineMax({ paused: false});


            var projectName = document.querySelector('.project-name-content');
            var categoryType = document.querySelector('.category-type');
            var description = document.querySelector('.project-description p');
            var link = document.querySelector('.project-link');
            var img = document.querySelector('.bg-cover');

            var scrollB = this.$scrollmagic;

            sectionTl.fromTo(img, 2,{y:0}, {y:200});

            const sceneParallax = scrollB.scene({
                triggerElement: '.bg-cover',
                triggerHook: 0,
                offset: 0,
                duration: 900
            })
            .setTween(sectionTl)
            scrollB.addScene(sceneParallax);

            if( link){
                anim
                    .from(categoryType, {y: 50 , duration: 2 , ease: "power4.inOut"}, "fire")
                    .from(projectName, {y: 230,  duration: 1.8 , ease: "power4.inOut"},"-=1" )
                    .from(description, {y: 30, opacity:0, duration: 1 },"-=0.5" )
                    .from(link, {y:30, opacity:0, duration: 1  },"-=0.2" )
                    .set('.link-container',{overflow:"visible"});
            }else{
                anim
                    .from(categoryType, {y: 50 , duration: 2 , ease: "power4.inOut"}, "fire")
                    .from(projectName, {y: 230,  duration: 1.8 , ease: "power4.inOut"},"-=1" )
                    .from(description, {y: 30, opacity:0, duration: 1.5 , ease: "power4.inOut"},"-=0.4" );            
            }
            anim.eventCallback("onComplete", function () {
                document.querySelector('.cross').classList.add("active");
            });

        },
    }
</script>

<style lang="scss" scoped>
    .project-header{
        position: relative;
        height: 100vh;
        width: 100vw;
        background-size: cover;
        background-position: 50%;
        color: white;
        overflow: hidden;
        .bg-cover{
            position: absolute;
            left: 0;
            top: 0;
            height: 100vh;
            width: 100%;
            object-fit: cover;
        }
        .project-header-content{
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
            max-width: 1113px;
            margin: 0 auto;
            .project-header-content-top{
                position: absolute;
                top: 50%;
                transform: translateY(-60%);
                text-align: center;
            }
        }
        .category{
            font-family: 'GTWalsheimProMedium';
            text-transform: uppercase;
            letter-spacing: 1px;
            overflow: hidden;
        }
        .project-name{
            font-size: 200px;
            font-weight: bold;
            overflow: hidden;
        }
        .project-description{
            position: relative;
            align-self: flex-end;
            max-width: 370px;
            font-size: 23px;
            font-weight: bold;
            transform: translateY(210px);
        }
        .link-container{
            position: relative;
            display: block;
            margin-top: 40px;
            min-height: 22px;
            overflow: hidden;
        }
        .project-link{
            position: absolute;
            display: inline-block;
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-family: 'GTWalsheimProMedium';
            padding: 2px 0 15px;
        }
        @media only screen and ( max-width : 1280px ) {
            .project-name{
                font-size: 15.667vw;
            }
        }
        @media only screen and ( max-width : 768px ) {
            .project-header-content{
                padding: 0 20px;
            }
            .project-name{
                // font-size: 150px;
            }
        }
        @media only screen and ( max-width : 680px ) {
            .project-header-content{
                .project-header-content-top{
                    top: 30%;
                }
            }
            .project-description{
                align-self: center;
                max-width: 90%;
                font-size: 19px;
                transform: translateY(0);
            }
            .project-name{
                font-size: 65px;
            }
        }
        .cross{
            padding-right: 15px;
            padding-bottom: 15px;
            &.fixed{
                position: fixed;
                .crossLineOne_content,
                .crossLineTwo_content{
                    background-color: black;
                }
            }
            .crossLineOne,
            .crossLineTwo{
                width: 25px;
            }
            .crossLineOne_content,
            .crossLineTwo_content{
                background-color: white;
            }
            .back-link{
                display: block;
                height: 100%;
            }
        }
    }
</style>