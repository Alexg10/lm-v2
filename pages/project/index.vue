<template>
    <div class="list-container">
        <div v-if="projects" class="project-list">
            <div ref="cover" class="project-cover" >
                <img class="project-cover-img" :src="cover" alt="" ref="coverImg">
            </div>
            <div class="project-title-container" @mouseenter="projectEnter" @mouseleave="projectLeave">
                <div class="project-title" @click="clickSlide"></div>
            </div>
            <slick-slide ref="slick" :options="slickOptions" class="home-slider" @afterChange="handleAfterChange" @beforeChange="handleBeforeChange" @init="handleInit" >
                <div v-for="project in projects" class="project-slide" :key="project.id" @click="clickSlide" ref="slides" :data-slug="project.slug">
                    <div class="slide-link" @mouseenter="projectEnter" @mouseleave="projectLeave">
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
            <div class="prev-project" @mouseenter="prevSlideEnter" @mouseleave="prevSlideLeave" @click="prevSlide"></div>
            <div class="next-project" @mouseenter="nextSlideEnter" @mouseleave="nextSlideLeave" @click="nextSlide"></div>
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
                    slidesToShow : 1,
                    speed        : 1200,
                    infinite     : true,
                    centerMode   : true,
                    centerPadding: '20%',
                    arrows       : false,
                    cssEase      : 'cubic-bezier(.19,.77,.2,1)',
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
                prefetch: true,
                query   : projects,
                update  : (data) => data.projects.nodes
            }
        },
        methods: {
            handleInit(event, slick){
                const current            = slick.$slides[0];
                const prev               = current.previousSibling;
                const next               = current.nextSibling;
                const currentName        = current.querySelector('.project-name').textContent;
                const projectSlideWidth  = current.querySelector('.project-slide').offsetWidth;
                const projectSlideHeight = current.querySelector('.project-slide').offsetHeight;

                document.querySelector('.project-title').innerHTML = currentName;

                var introTl = gsap.timeline({delay: 1})
                introTl.add('start');
                introTl.to( this.$refs.cover, {width: projectSlideWidth, duration: 3, ease: "power4.inOut"},'animIntroStart')
                    .to( this.$refs.cover, {height: projectSlideHeight, duration: 3, ease: "power4.inOut"},'animIntroStart=+0.5')
                    .to(this.$refs.coverImg, {scale:1, duration: 3, ease: "power4.inOut"},'animIntroStart')
                    .to(".slide-img", { scale:1, duration: 3, ease: "power4.inOut"},'animIntroStart')
                    .from(prev, {x:'-20%', duration: 3, ease: "power4.inOut"},'animIntroStart=+3')
                    .from(next, {x:'20%', duration: 3, ease: "power4.inOut"},'animIntroStart=+3');

                introTl.eventCallback("onComplete", ()=> {
                    this.$refs.cover.style.display = "none";
                    document.querySelector('.project-title').classList.add("visible");
                });

                document.querySelector('.list-container').onmousemove = event => {
                    this.parallax(event);
                }
            },
            handleAfterChange(event, slick){
                var   currentNb   = slick.currentSlide
                var   current     = slick.$slides[currentNb];
                const currentName = current.querySelector('.project-name').textContent;

                document.querySelector('.project-title').innerHTML = currentName;
                document.querySelector('.project-title').classList.add("visible");
            },
            handleBeforeChange(){
                document.querySelector('.project-title').classList.remove("visible");
            },
            scrollSlide(){
                var vm         = this;
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
            parallax(e){
                var imgW         = window.innerWidth*0.53;
                var imgH         = window.innerHeight*0.53;
                var amountMovedX = (e.pageX * -0.3 / 10)-imgW;
                var amountMovedY = (e.pageY * -0.3 / 10)-imgH;

                document.querySelector('.slick-current .slide-img').style.transform = 'translate(' + amountMovedX + 'px,' + amountMovedY + 'px)';
            },
            projectEnter(){
                document.querySelector('.project-title').classList.add('hover');
                document.querySelector('.slick-current .project-slide').classList.add('hover');
            },
            projectLeave(){
                document.querySelector('.project-title').classList.remove('hover');
                document.querySelector('.slick-current .project-slide').classList.remove('hover');
            },
            //PREV
            prevSlide(){
                this.$refs.slick.prev();
            },
            prevSlideEnter(){
                document.querySelector('.prev-project').classList.add('hover');
                document.querySelector('.slick-current').previousSibling.classList.add('hover');
            },
            prevSlideLeave(){
                document.querySelector('.prev-project').classList.remove('hover');
                document.querySelector('.slick-current').previousSibling.classList.remove('hover');
            },
            //NEXT
            nextSlide(){
                this.$refs.slick.next();
            },
            nextSlideEnter(){
                document.querySelector('.next-project').classList.add('hover');
                document.querySelector('.slick-current+div').classList.add('hover');
            },
            nextSlideLeave(){
                document.querySelector('.next-project').classList.remove('hover');
                document.querySelector('.slick-current+div').classList.remove('hover');
            },
            animLeaveLetters(){
                var word = document.querySelector(".project-title");

                //ADD SPAN TO LETTERS
                var wordContent      = word.textContent.trim();
                var wordContentSplit = wordContent.split("");
                    word.innerHTML   = "";
                var tabLetterLength  = [];

                for(var i=0; i< wordContentSplit.length; i++){
                    var newSpan = document.createElement('span');
                    newSpan.style.display = "inline-block";
                    newSpan.style.minWidth = "40px";
                    newSpan.setAttribute("class", "letter-"+i);
                    newSpan.innerHTML = wordContentSplit[i];
                    word.appendChild(newSpan);
                    tabLetterLength.push(i)
                }

                var currentIndex = tabLetterLength.length, 
                    temporaryValue, 
                    randomIndex;
                while (0 !== currentIndex) {
                    randomIndex = Math.floor(Math.random() * currentIndex);
                    currentIndex -= 1;
                    temporaryValue = tabLetterLength[currentIndex];
                    tabLetterLength[currentIndex] = tabLetterLength[randomIndex];
                    tabLetterLength[randomIndex] = temporaryValue;
                }

                document.querySelector(".project-title-container").classList.add('visible');
                document.querySelector(".project-title").classList.add('visibleOpacity');
                //Anim LETTERS
                var letterTrans = new TimelineMax({});
                setTimeout(() => {
                    tabLetterLength.forEach(function(element){
                        var elemToAnim = document.querySelector('.project-title .letter-'+element+'');
                        letterTrans.fromTo(elemToAnim , 0.8, {scaleX:1, scaleY:1, opacity:1},{scaleX:3, scaleY:3, opacity:0, ease: Power4.easeInOut, overwrite: false},"-=0.55");    
                        //! IF PASS TO WHITE
                        // letterTrans.fromTo(elemToAnim , 0.75, {scaleX:1, scaleY:1, opacity:1},{color: "white", ease: Power4.easeInOut, overwrite: false},"-=0.55");    
                    });
                }, 300);
            },

            //CLICK
            clickSlide(elem, slick){
                var vm             = this;
                var currentNbSlide = this.$refs.slick.$el.slick.currentSlide;
                var currentCover   = this.$refs.slick.$el.querySelector('.slide-img').src;
                var prev           = this.$refs.slick.$el.slick.$slides[currentNbSlide].previousElementSibling;
                var next           = this.$refs.slick.$el.slick.$slides[currentNbSlide].nextElementSibling;
                var projectSlug    = document.querySelector('.slick-current .project-slide').dataset.slug;

                document.querySelector('.slide-layer').classList.add('visible');
                //! STORE COVER DOESN'T WORK
                // vm.$store.commit('setCover', currentCover);

                this.animLeaveLetters();

                var outroTl = gsap.timeline({timeScale: 0.5})
                outroTl.add('start');
                outroTl
                    .to(prev, {x:'-20%', duration: 0.3, ease: "power4.in"},'start')
                    .to(next, {x:'20%', duration: 0.3, ease: "power4.in"},'start')
                    .to('.slick-current .slide-img',{x:"-50%", y:"-50%", scale:1, duration: 2, ease: "power4.inOut"},'start')
                    .to('.slide-layer',{opacity:0, duration: 0.5, ease: "power4.inOut"},'start+=1.5')
                    .set('.project-cover',{display:"block"},'start+=2')
                    .set('.project-cover-img',{x:"-50%", y:"-50%"},'start+=2')
                    .to('.project-cover', {width: "100vw", height: "100vh", duration: 2, ease: "power4.inOut"}, 'start+=2.5');

                outroTl.eventCallback("onComplete", ()=> {
                    //! HOW TO DELTE METHODS?
                    delete this.projectLeave();
                    delete this.projectEnter();
                    // delete this.parallax();
                    vm.$store.commit('setCover', currentCover);
                    vm.$router.push({
                        path: `/project/${projectSlug}`
                    })
                });

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
    .prev-project,
    .next-project{
        position: absolute;
        left: 0;
        top: 50%;
        width: 10%;
        height: 100%;
        max-height: 746px;
        background-color: transparent;
        transform: translateY(-50%);
        transition: 0.6s ease-in-out;
        cursor: pointer;
        &.hover{
            width: calc(10% + 30px);
            transition: 0.6s ease-in-out;
        }
    }
    .next-project{
        left: auto;
        right: 0;
    }
    .project-cover{
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100vw;
        height: 100vh;
        z-index: 99;
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
        max-width: 590px;
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
            transform: scale(1.1) translate(-50%,-50%);
        }
    }

    .project-name,
    .project-title{
        position: relative;
        display: inline-block;
        text-decoration: none;      
        white-space: nowrap;  
        font-size: 200px;
        text-decoration: none;     
        transform: translateY(210px);
        color: #FF9170;
        opacity: 0;
        transition: all 0.5s ease;
        z-index: 101;
    }
    .project-title-container{
        position: absolute;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 100;
        overflow: hidden;
        &.visible{
            overflow: visible;
        }
        .project-title{
            opacity: 0.3;
            &.visibleOpacity{
                opacity: 1;
            }
            &.visible{
                transform: translateY(0);
                transition: all 0.6s ease;
            }
            &.hover{
                opacity: 1;
            }
        }

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
        .project-slide{
            &.hover,
            &:hover{
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
        &.visible{
            opacity: 1;
        }
    }

</style>