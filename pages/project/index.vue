<template>
    <div class="list-container" v-on:mousewheel="scrollSlide">
        <div class="logo" >
            <div class="logo-container" v-on:mouseenter="logoHover" v-on:mouseleave="logoLeave" v-on:click="logoClick">
                <span class="letter first-letter">L</span>
                <span class="letter second-letter">M</span>
            </div>
        </div>
        <div v-if="projects" class="project-list">

            <div ref="cover" class="project-cover" >
                <img class="project-cover-img" :src="cover" alt="" ref="coverImg">
            </div>
            <div v-if="currentProject.acfProjectFields" :class="currentProject.acfProjectFields.projectTitle  == 'Terres de Sable' ? 'project-title-container two-lines' : 'project-title-container'" @mouseenter="projectEnter" @mouseleave="projectLeave">
                <div class="project-title link-hover" @click="clickSlide">{{currentProject.acfProjectFields.projectTitle}}</div>
            </div>
            <slick-slide ref="slick" :options="slickOptions" class="home-slider" @afterChange="handleAfterChange" @beforeChange="handleBeforeChange" @init="handleInit" >
                <div v-for="project in projects" class="project-slide link-hover" :key="project.id" @click="clickSlide" ref="slides">
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
            <div  class="prev-project" @mouseenter="prevSlideEnter" @mouseleave="prevSlideLeave" @click="prevSlide"></div>
            <div class="next-project" @mouseenter="nextSlideEnter" @mouseleave="nextSlideLeave" @click="nextSlide"></div>
        </div>
    </div>
</template>

<script>

    import gsap from "gsap"
    import projects from '~/queries/projects'

    export default {
        head: {
            bodyAttrs: {
                class: 'fixed'
            }
        },
        transition: 'listFade',
        data(){
            return{
                currentIndex: 0,
                isLeave: false,
                slickOptions: {
                    slidesToShow : 1,
                    speed        : 900,
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
                return this.projects[this.currentIndex].acfProjectFields.headerPicture.sourceUrl;
            },
            currentProject(){
                return this.projects[this.currentIndex];
            },
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
                let slickSlider = slick;
                let back = this.$store.state.back;
                var vm = this;

                function animIntro(index){
                    var index = 0;
                    if(back){
                        document.querySelector('.project-cover').classList.add('hide');

                        let project = vm.$store.state.fromProject;
                        let projectLength = vm.projects.length;
                        for (var i = 0; i<projectLength; i++){
                            if(vm.projects[i].slug == project){
                                index = i;
                            }
                        }
                        slickSlider.goTo(index);
                    }

                    const current            = slickSlider.$slides[index];
                    const prev               = current.previousSibling;
                    const next               = current.nextSibling;
                    const projectSlideWidth  = current.querySelector('.project-slide').offsetWidth;
                    const projectSlideHeight = current.querySelector('.project-slide').offsetHeight;

                    var introTl = gsap.timeline({delay: 1})
                    introTl.add('start');

                    if((!vm.$device.ipad) && (!vm.$device.mobile)){
                        if(!back){
                            introTl.to( vm.$refs.cover, {width: projectSlideWidth, duration: 2.5, ease: "power4.inOut"},'animIntroStart')
                                .from('.home-slider',{opacity: 0, duration: 1.8, ease: "power4.inOut"},'animIntroStart')
                                .to( vm.$refs.cover, {height: projectSlideHeight, duration: 2, ease: "power4.inOut"},'animIntroStart+=0.5')
                                .to(vm.$refs.coverImg, {scale:1, duration: 2.3, ease: "power4.inOut"},'animIntroStart')
                                .to(".slide-img", { scale:1, duration: 2.3, ease: "power4.inOut"},'animIntroStart')
                                .from(prev, {x:'-20%', duration: 2.3, ease: "power4.inOut"},'animIntroStart+=1')
                                .from(next, {x:'20%', duration: 2.3, ease: "power4.inOut"},'animIntroStart+=1');
                        }else{
                            introTl.to( vm.$refs.cover, {width: projectSlideWidth, duration: 2.5, ease: "power4.inOut"},'animIntroStart')
                                .from('.home-slider',{opacity: 0, duration: 2, ease: "power4.inOut"},'animIntroStart')
                                .to( vm.$refs.cover, {height: projectSlideHeight, duration: 2.2, ease: "power4.inOut"},'animIntroStart+=0.5')
                                .to(vm.$refs.coverImg, {scale:1, duration: 2.5, ease: "power4.inOut"},'animIntroStart')
                                .from(prev, {x:'-20%', duration: 2, ease: "power4.inOut"},'-=2.5')
                                .from(next, {x:'20%', duration: 2, ease: "power4.inOut"},'-=2.5')
                        }
                    }else{
                        introTl.to( vm.$refs.cover, {width: projectSlideWidth, duration: 4, ease: "power4.inOut"},'animIntroStart')
                            .from('.home-slider',{opacity: 0, duration: 2, ease: "power4.inOut"},'animIntroStart')
                            .to( vm.$refs.cover, {height: projectSlideHeight, duration: 3, ease: "power4.inOut"},'animIntroStart+=0.5')
                            .to(vm.$refs.coverImg, {scale:0.7, duration: 4, ease: "power4.inOut"},'animIntroStart')
                            .to(".slide-img", { scale:0.7, duration: 4, ease: "power4.inOut"},'animIntroStart')
                            .from(prev, {x:'-30%', duration: 1},'animIntroStart+=3.5')
                            .from(next, {x:'30%', duration: 1},'animIntroStart+=3.5')
                            .to({}, 0.5, {});
                    }

                    introTl.eventCallback("onComplete", ()=> {
                        vm.$refs.cover.style.display = "none";
                        document.querySelector('.project-title').classList.add("visible");
                        current.querySelector(".project-slide").classList.remove("hover");
                        document.querySelector('.home-slider').classList.add('ready');
                        setTimeout(() => {
                            document.querySelector('.logo').classList.add("visible");
                        }, 600);
                        vm.$store.commit("setBack", false);
                        document.querySelector('.project-cover').classList.remove('hide');
                    });
                }

                animIntro();

                if((!this.$device.ipad) && (!this.$device.mobile)){
                    document.querySelector('.list-container').onmousemove = event => {
                        this.parallax(event);
                    }
                }
            },
            handleAfterChange(event, slick, currentId){
                this.currentIndex = currentId;
                document.querySelector('.project-title').classList.add("visible");
                if((this.$device.ipad) && (this.$device.mobile)){
                    vm.currentProject.child(".project-slide").classList.remove("hover");
                }

            },
            handleBeforeChange(){
                document.querySelector('.project-title').classList.remove("visible");
            },
            scrollSlide(e){
                var vm         = this;
                var scrollable = true;

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
//                 var imgW         = window.innerWidth*0.48;
//                 var imgH         = window.innerHeight*0.48;
//                 var amountMovedX = (e.pageX * -0.3 / 10)-imgW;
//                 var amountMovedY = (e.pageY * -0.3 / 10)-imgH;

// //TRANSFORMER EN %%%
//                 document.querySelector('.slick-current .slide-img').style.transform = 'translate(' + amountMovedX + 'px,' + amountMovedY + 'px)';
            },
            projectEnter(){
                // console.log(this.isLeave);
                if(!this.isLeave){
                    if((!this.$device.ipad) && (!this.$device.mobile)){
                        document.querySelector('.cursor').classList.add('hover');
                    }
                    document.querySelector('.project-title').classList.add('hover');
                    document.querySelector('.slick-current .project-slide').classList.add('hover');
                }

            },
            projectLeave(){
                // console.log(this.isLeave);
                if(!this.isLeave){
                    if((!this.$device.ipad) && (!this.$device.mobile)){
                        document.querySelector('.cursor').classList.remove('hover');
                    }
                    document.querySelector('.project-title').classList.remove('hover');
                    document.querySelector('.slick-current .project-slide').classList.remove('hover');
                }
            },
            //PREV
            prevSlide(){
                this.$refs.slick.prev();
            },
            prevSlideEnter(){
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    if((!this.$device.ipad) && (!this.$device.mobile)){
                        document.querySelector('.cursor').classList.add('hover');
                    }
                    document.querySelector('.prev-project').classList.add('hover');
                    document.querySelector('.slick-current').previousSibling.classList.add('hover');
                }
            },
            prevSlideLeave(){
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    if((!this.$device.ipad) && (!this.$device.mobile)){
                        document.querySelector('.cursor').classList.remove('hover');
                    }
                    document.querySelector('.prev-project').classList.remove('hover');
                    document.querySelector('.slick-current').previousSibling.classList.remove('hover');
                }
            },
            //NEXT
            nextSlide(){
                this.$refs.slick.next();
            },
            nextSlideEnter(){
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    if((!this.$device.ipad) && (!this.$device.mobile)){
                        document.querySelector('.cursor').classList.add('hover');
                    }
                    document.querySelector('.next-project').classList.add('hover');
                    document.querySelector('.slick-current+div').classList.add('hover');
                }
            },
            nextSlideLeave(){
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    if((!this.$device.ipad) && (!this.$device.mobile)){
                        document.querySelector('.cursor').classList.remove('hover');
                    }
                    document.querySelector('.next-project').classList.remove('hover');
                    document.querySelector('.slick-current+div').classList.remove('hover');
                }
            },
            animLeaveLetters(){
                let vm = this;
                var word = document.querySelector(".project-title");

                //ADD SPAN TO LETTERS
                var wordContent      = word.textContent.trim();
                var wordContentSplit = wordContent.split("");
                    word.innerHTML   = "";
                var tabLetterLength  = [];

                for(var i=0; i< wordContentSplit.length; i++){
                    var newSpan = document.createElement('span');
                    newSpan.style.display = "inline-block";
                    if((!vm.$device.ipad) && (!vm.$device.mobile)){
                        newSpan.style.minWidth = "38px";
                    }else{
                        newSpan.style.minWidth = "25px";
                    }
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
                    currentIndex   -= 1;
                    temporaryValue  = tabLetterLength[currentIndex];
                    tabLetterLength[currentIndex]   = tabLetterLength[randomIndex];
                    tabLetterLength[randomIndex]    = temporaryValue;
                }

                document.querySelector(".project-title-container").classList.add('visible');
                document.querySelector(".project-title").classList.add('visibleOpacity');
                //Anim LETTERS
                var letterTrans = new TimelineMax({});
                setTimeout(() => {
                    tabLetterLength.forEach(function(element){
                        var elemToAnim = document.querySelector('.project-title .letter-'+element+'');
                        letterTrans.fromTo(elemToAnim , 0.4, {scaleX:1, scaleY:1, opacity:1},{scaleX:3, scaleY:3, opacity:0, ease: Power4.easeInOut, overwrite: false},"-=0.2");
                    });
                }, 300);
            },
            logoHover(){
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    document.querySelector('.cursor').classList.add('hover');
                }
            },
            logoLeave(){
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    document.querySelector('.cursor').classList.remove('hover');
                }
            },
            logoClick(){
                const vm = this;
                this.isLeave = true;
                document.querySelector('.logo').classList.remove('visible');
                document.querySelector('.project-title').classList.add('hidden');
                let slide;
                slide = document.querySelectorAll(".project-slide");
                for (let i = 0; i < slide.length; ++i) {
                    slide[i].classList.add('hidden');
                }
                this.$store.commit("setBack", true);
                setTimeout(function(){
                    vm.$router.push({
                        path: '/'
                    })
                }, 2500);
            },

            //CLICK
            clickSlide(elem, slick){
                this.isLeave = true;
                var vm             = this;
                var currentNbSlide = this.$refs.slick.$el.slick.currentSlide;
                var prev           = this.$refs.slick.$el.slick.$slides[currentNbSlide].previousElementSibling;
                var next           = this.$refs.slick.$el.slick.$slides[currentNbSlide].nextElementSibling;

                document.querySelector('.slide-layer').classList.add('visible');
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    document.querySelector('.cursor').classList.remove('hover');
                }

                this.animLeaveLetters();

                var outroTl = gsap.timeline({timeScale: 0.5})
                outroTl.add('start');
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    outroTl
                        .to(prev, {x:'-20%', duration: 0.3, ease: "power4.in"},'start')
                        .to(next, {x:'20%', duration: 0.3, ease: "power4.in"},'start')
                        .to('.slick-current .slide-img',{xPercent:-50, yPercent:-50, scale:1, duration: 1.5, ease: "power4.inOut"},'start')
                        .to('.project-type', {y: 50, duration: 0.3, ease: "power4.inOut"}, 'start+=1.3')
                        .to('.slide-layer',{opacity:0, duration: 0.7, ease: "power4.inOut"},'start+=1.8')
                        .set('.project-cover',{display:"block"},'start+=2')
                        .to('.project-cover', {width: "100%", height: "100vh", duration: 1.5, ease: "power4.inOut"}, 'start+=2');
                }else{
                    outroTl
                        .to(prev, {x:'-20%', duration: 0.5, ease: "power4.in"},'start')
                        .to(next, {x:'20%', duration: 0.5, ease: "power4.in"},'start')
                        .to('.slick-current .slide-img',{xPercent:-50, yPercent:-50, duration: 2, ease: "power4.inOut"},'start')
                        .to('.slide-layer',{opacity:0, duration: 1, ease: "power4.inOut"},'start')
                        .to('.project-type', {y: 50, duration: 0.5, ease: "power4.inOut"}, 'start+=0.5')
                        .set('.project-cover',{display:"block"},'start+=2.3')
                        .to('.project-cover-img', {scale: 1, duration: 2, ease: "power4.inOut"}, 'start+=2.5')
                        .to('.project-cover', {width: "100%", height: "100vh", duration: 2, ease: "power4.inOut"}, 'start+=2.5');
                }

                outroTl.eventCallback("onComplete", ()=> {
                    vm.$store.commit('setCover', vm.currentProject);
                    vm.$router.push({
                        path: `/project/${vm.currentProject.slug}`
                    })
                });
            }
        },
        mounted() {
            this.keySlide();
        }
    }
</script>

<style lang="scss" scoped>
    body {
        overscroll-behavior-x: none;
    }
    .list-container{
        overflow: hidden;
        width: 100vw;
        height: 100vh;
        overscroll-behavior-x: none;
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
        cursor: none;
        &.hover{
            width: calc(10% + 30px);
            transition: 0.6s ease-in-out;
        }
    }
    .home-slider{
        height: 100%;

        &.hidden{
            height: 0;
            overflow: hidden;
            transition: all 1.1s cubic-bezier(.19,.77,.2,1);
            transition-delay: 1s;
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
        pointer-events: none;
        .project-cover-img{
            position: absolute;
            width: 100%;
            height: 100vh;
            top: 50%;
            left: 50%;
            transform: scale(1) translate(-50%,-50%);
            object-fit: cover;
            @media ( max-width : 780px ) {
                width: auto;
            }
        }
        &.hide{
            visibility: hidden;
            opacity: 0;
        }
    }
    .project-slide{
        position: relative;
        height: auto;
        align-self: center;
        overflow: visible;
        display: block;
        height: 100%;
        width: 48%!important;
        max-width: 590px;
        overflow: hidden;
        transition: all 1.4s cubic-bezier(0.24, 0.88, 0.41, 0.99);
        margin: 0 15%;
        @media ( max-width : 780px ) {
            width: 80%!important;
            margin: 0 14%;
        }

        &.hidden{
            height: 0!important;
            transition: all 1s cubic-bezier(0.24, 0.88, 0.41, 0.99);
            transition-delay: 1s;
        }
    }
    .project-name-container,
    .project-type-container{
        overflow: hidden;
    }

    .project-list{
        position: relative;
        .slide-img{
            position: absolute;
            top: 50%;
            left: 50%;
            height: 100vh;
            width: 100%;
            object-fit: cover;
            transform: translate(-50%,-50%);
            @media ( max-width : 780px ) {
                font-size: 70px;
                width: auto;
            }
        }
    }
    .project-name,
    .project-title{
        position: relative;
        display: inline-block;
        text-decoration: none;
        white-space: nowrap;
        font-size: 200px;
        text-align: center;
        text-decoration: none;
        transform: translateY(470px);
        color: #FF9170;
        opacity: 0;
        transition: all 0.8s ease;
        z-index: 101;
        @media ( max-width : 780px ) {
            font-size: 140px;
        }
        @media ( max-width : 680px ) {
            font-size: 70px;
        }
    }
    .two-lines{
        width: 90%;
        max-width: 960px;
        .project-name,
        .project-title{
            transform: translateY(470px);
            transition: all 1s ease;
            white-space: normal;
            line-height: 170px;
            @media ( max-width : 780px ) {
                line-height: 120px;
                max-width: 600px;
            }
            @media ( max-width : 680px ) {
                line-height: 60px;
                max-width: 305px;

            }
        }
    }
    .project-name-container{
        max-height: 250px;
    }
    .project-title-container{
        position: absolute;
        text-align: center;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 100;
        overflow: hidden;
        &.visible{
            overflow: visible;
        }
        .project-title{
            opacity: 0.5;
            @media ( max-width : 780px ) {
                opacity: 1;
                letter-spacing: -1px;
            }
            &.visibleOpacity{
                opacity: 1;
            }
            &.visible{
                transform: translateY(0);
                transition: all 0.5s ease;
            }
            &.hover{
                opacity: 1;
            }
            &.hidden{
                transform: translateY(230px)!important;
                transition: all 0.6s ease;
                transition-delay: 0.5s;
            }
        }

    }
    .project-type{
        color: white;
        font-size: 16px;
        font-family: 'GTWalsheimProMedium';
        text-transform: uppercase;
        letter-spacing: 1px;
        transform: translateY(50px);
        transition: 0.5s ease-in-out;
        pointer-events: none;
        text-align: center;
        @media ( max-width : 780px ) {
            font-size: 14px;
        }
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
            @media ( max-width : 780px ) {
                .slide-layer{
                    opacity: 0.4;
                }
                .project-type{
                    transform: translateY(0);
                    transition: transform 0.6s ease;
                    transition-delay: 2s;

                }
            }
            @media ( max-width : 680px ) {
                width: 95%!important;
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
    .logo{
        position: absolute;
        width: 100%;
        top: 0;
        left: 0;
        text-align: center;
        font-size: 22px;
        z-index: 9;
        padding-top: 30px;
        @media ( max-width : 780px ) {
            padding-top: 40px;
        }
        @media ( max-width : 680px ) {
            padding-top: 40px;
        }
        &.visible{
            .logo-container{
                .first-letter,
                .second-letter{
                    transform: translateY(0%);
                    transition: 0.5s ease-in-out;
                }
                .second-letter{
                    transition-delay:0.35s;
                }
            }
        }
        .logo-container{
            display: inline-block;
            padding-top: 4px;
            overflow: hidden;
            padding-bottom: 20px;
            padding-right: 20px;
            .letter{
                float: left;
            }
            .first-letter{
                position: relative;
                top: -8px;
                left: 1px;
                transform: translateY(-120%);
                transition: 0.3s ease;
            }
            .second-letter{
                position: relative;
                top: 8px;
                left: -1px;
                transform: translateY(0%);
                transform: translateY(-120%);
                transition: 0.3s ease;
                transition-delay:0.4s;
            }
        }
    }

</style>
