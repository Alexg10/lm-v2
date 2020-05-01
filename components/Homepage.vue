<template>
        <div class="homepage-container" v-touch:swipe.top="scrollDown" v-touch:swipe.bottom="scrollUp" v-on:mousewheel="scrollSlide">
            <div v-if='!this.$store.state.back' :class="!this.$store.state.back ? 'intro': 'intro hide'">
                <div class="word-container ">
                    <div class="word-wrapper word-wrapper-elle">
                        <div class="word louise">
                            <span class="hide">l</span>
                            <span class="hide">
                                <div class="hide-left">ouise</div>
                            </span>
                        </div>
                    </div>
                    <div class="word-wrapper word-wrapper-aime">
                        <div class="word margueritat">
                            <span class="hide">m</span>
                            <span class="hide">
                                <div class="hide-left">argueritat</div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide love-container">
                <div class="home-slide-content red">
                    <div class="bg-love">
                        <img class="bg-love-cover cover-1 visible" src="/images/home/lm_33.png" alt="">
                        <img class="bg-love-cover cover-2" src="/images/home/lm_44.png" alt="">
                        <img class="bg-love-cover cover-3" src="/images/home/lm_22.png" alt="">
                        <img class="bg-love-cover cover-4" src="/images/home/lm_flower.png" alt="">
                        <img class="bg-love-cover cover-5" src="/images/home/lm_fluffy.png" alt="">
                        <img class="bg-love-cover cover-6" src="/images/home/lm_clouds.png" alt="">
                    </div>
                    <LoveContent/>
                    <div class="word-container " v-on:mouseenter="loveHover" v-on:mouseleave="loveLeave" v-on:click="loveClick">
                        <div class="word-wrapper word-wrapper-elle">
                            <div class="word elle">
                                <span class="hide">
                                    <div class="hide-right">el</div>
                                </span>
                                <span class="hide">l</span>
                                <span class="hide">
                                    <div class="hide-left">e</div>
                                </span>
                            </div>
                        </div>
                        <div class="word-wrapper word-wrapper-aime">
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
                    <div class="circle-container love" v-touch:start="loveHold" v-touch:end="loveHoldEnd">
                        <svg class="circle" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <ellipse class="foreground" ry="43" rx="43" cy="46" cx="46" stroke-width="1"/>
                            </g>
                        </svg>
                        <div class="hover-text-container">
                            <div class="circle-text">Hold me</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide work-container">
                <div class="home-slide-content orange">
                    <nuxt-link to="project">
                        <div class="word-container" v-on:mouseenter="workHover" v-on:mouseleave="particuleAnimLeave"  v-on:click="workClick" >
                            <div class="word-wrapper word-wrapper-work" >
                                <span class="word work">work</span>
                            </div>
                            <div class="word-wrapper word-wrapper-work">
                                <span class="word work">work</span>
                            </div>
                            <div class="word-wrapper word-wrapper-work">
                                <span class="word work">work</span>
                            </div>
                        </div>
                    </nuxt-link>
                </div>
                <div class="circle-container work-hold" v-touch:start="workHold" v-touch:end="workHoldEnd">
                    <svg class="circle" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <ellipse class="foreground" ry="43" rx="43" cy="46" cx="46" stroke-width="1"/>
                        </g>
                    </svg>
                    <div class="hover-text-container">
                        <div class="circle-text">Hold me</div>
                    </div>
                </div>
            </div>
            <img class="arrow link link-hover" :src="arrowDown" alt="" v-on:click="scrollDown" data-cursor-hover>
        </div>
</template>

<script>
    import gsap from "gsap"
    import LoveContent from '~/components/project/LoveContent.vue'
    import arrowDown from '~/assets/images/ico/arrow-down-ico.svg'

    export default {
        components:{
            LoveContent
        },
        data(){
            return{
                arrowDown,
                coverIndex     : 1,
                playing        : '',
                coundownTime: '',
                scrollable     : false,
                tlIntro        : gsap.timeline({delay:1}),
                LoveClickTl    : gsap.timeline({paused: true}),
                workClickTl    : gsap.timeline({paused: true}),
                loveInit       : gsap.timeline(),
                loveUp         : gsap.timeline({paused: true}),
                loveUpR        : gsap.timeline({paused: true}),
                loveUpUp       : gsap.timeline({paused: true}),
                loveDown       : gsap.timeline({paused: true}),
                loveDownDown   : gsap.timeline({paused: true}),
                workUp         : gsap.timeline({progress: 1}),
                workUpUp       : gsap.timeline({progress: 1}),
                workDownDown   : gsap.timeline({progress: 1}),
                workDown       : gsap.timeline({progress: 1}),
                loveShowContent: gsap.timeline({paused: true}),
                hoverEffect    : new TimelineMax({ paused: false})

            }
        },

        methods: {
            scrollUp(){
                var vm = this;
                vm.scrollable = false;
                if((vm.$device.ipad) || (vm.$device.mobile)){
                    document.querySelectorAll('.circle-container.work-hold, .circle-container.love').forEach(el => el.classList.remove('visible'));
                }
                if( !document.querySelector('.work-container').classList.contains('visible') ){
                    document.querySelector('.work-container').classList.add("visible");
                    console.log('UP FROM LOVE ');
                    vm.loveDown.pause(0);
                    vm.loveDown.play();
                    vm.loveDown.eventCallback("onComplete", function () {
                        vm.workDownDown.pause(0);
                        vm.workDownDown.play();
                        if((vm.$device.ipad) || (vm.$device.mobile)){
                            document.querySelector('.circle-container.work-hold').classList.add("visible");
                        }
                    });
                }else{
                    console.log('UP FROM WORK ')
                    vm.workDown.pause(0);
                    vm.workDown.play();
                    vm.workDown.eventCallback("onComplete", function () {
                        document.querySelector('.work-container').classList.remove("visible");
                        vm.loveDownDown.pause(0);
                        vm.loveDownDown.play();
                        if((vm.$device.ipad) || (vm.$device.mobile)){
                            document.querySelector('.circle-container.love').classList.add("visible");
                        }
                    });
                }
                setTimeout(() => {
                    vm.scrollable = true;
                }, 1500);
            },
            scrollDown(){
                var vm = this;
                vm.scrollable = false;
                if((vm.$device.ipad) || (vm.$device.mobile)){
                    document.querySelectorAll('.circle-container.work-hold, .circle-container.love').forEach(el => el.classList.remove('visible'));
                }
                if( document.querySelector('.work-container').classList.contains('visible') ){
                    console.log('Down FROM Work ');
                    vm.workUpUp.time(0);
                    vm.workUpUp.play();
                    vm.workUpUp.eventCallback("onComplete", function () {
                        document.querySelector('.work-container').classList.remove("visible");
                        vm.loveUpR.pause(0);
                        vm.loveUpR.play();
                        if((vm.$device.ipad) || (vm.$device.mobile)){
                            document.querySelector('.circle-container.love').classList.add("visible");
                        }
                    });
                }else{
                    document.querySelector('.work-container').classList.add("visible");
                    console.log('Down FROM LOVE ');
                    vm.loveUpUp.pause(0);
                    vm.loveUpUp.play();
                    vm.loveUpUp.eventCallback("onComplete", function () {
                        vm.workUp.pause(0);
                        vm.workUp.play();
                        if((vm.$device.ipad) || (vm.$device.mobile)){
                            document.querySelector('.circle-container.work-hold').classList.add("visible");
                        }
                    });
                }
                setTimeout(() => {
                    vm.scrollable = true;
                }, 1500);
            },
            scrollSlide(e){
                const vm = this;
                if (e.deltaY < 0 && vm.scrollable) {
                    vm.scrollUp();
                }
                if (e.deltaY > 0 && vm.scrollable) {
                    vm.scrollDown();
                }
            },
            keySlide(e) {
                const vm = this;
                document.onkeydown = function(e){
                    e = e || window.event;
                    if (e.keyCode == '38') {
                        vm.scrollUp();
                    }
                    else if (e.keyCode == '40') {
                        vm.scrollDown();
                    }
                    else if (e.keyCode == '37') {
                        vm.scrollUp();
                    }
                    else if (e.keyCode == '39') {
                        vm.scrollDown();
                    }
                }
            },
            createAbout(){
                const aboutBlock = document.createElement('div');
                aboutBlock.className = 'about-block';
                aboutBlock.innerHTML = 'about me';
                
                const aboutContainer = document.querySelector('.cursor-fx__inner');
                aboutContainer.appendChild( aboutBlock );
            },
            loveHover(){
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    document.querySelector('.bg-love').classList.add("visible");
                    document.querySelector('.cursor-fx__inner__outside').classList.add('transparent');
                    document.querySelector('.about-block').classList.add('visible');
                    this.hoverEffect.play();

                    this.playing = setInterval(() => {
                        this.gif();
                    }, 250);
                }
            },
            countdown(action){
                const vm = this;
                let time = 5;
                if(action == "play"){
                    this.coundownTime = setInterval(() => {
                        time--;
                        if (time == 0){
                            vm.loveClick();
                            setTimeout(() => {
                                vm.loveHoldEnd();
                            }, 1000);
                            clearInterval(this.coundownTime);
                        }
                    }, 1000);
                }else {
                    clearInterval(this.coundownTime);
                }
            },
            loveHold(){
                const vm = this;
                this.scrollable = false;
                let time = 5;
                document.querySelector('.bg-love').classList.add("visible");
                document.querySelector('.love-container .word-container').classList.add("hover");
                document.querySelector('.circle-container.love').classList.add("hold");
                this.playing = setInterval(() => {
                    this.gif();
                }, 250);

                this.countdown("play")
            },
            loveHoldEnd(){
                document.querySelector('.bg-love').classList.remove("visible");
                document.querySelector('.love-container .word-container').classList.remove("hover");
                document.querySelector('.circle-container.love').classList.remove("hold");

                clearInterval(this.playing);
                this.countdown("stop")
                this.scrollable = true;
            },
            loveLeave(){
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    document.querySelector('.bg-love').classList.remove("visible");
                    document.querySelector('.cursor-fx__inner__outside').classList.remove('transparent');
                    document.querySelector('.about-block').classList.remove('visible');
                    this.hoverEffect.play().timeScale(2).reverse();
                    clearInterval(this.playing);
                }
            },
            loveClick(){
                const vm = this;

                this.LoveClickTl.pause(0);
                this.loveShowContent.pause(0);
                this.LoveClickTl.play();
                document.querySelector('.word-container').classList.add("clicked");
                this.LoveClickTl.eventCallback("onComplete", function () {
                    if((!vm.$device.ipad) && (!vm.$device.mobile)){
                        document.querySelector('.bg-love').classList.remove("visible");
                    }
                    document.querySelector('.love-content').classList.add("visible");
                    document.querySelector('.circle-container').classList.remove("visible");
                });
                this.loveShowContent.play();
            },
            workHold(){
                document.querySelector('.work-container .word-container').classList.add("hover");
                this.particuleAnim();
                this.scrollable = false;
            },
            workHoldEnd(){
                document.querySelector('.work-container .word-container').classList.remove("hover");
                this.particuleAnimLeave();
                this.scrollable = true;
            },
            workHover(){
                this.particuleAnim()
            },
            workClick(){
                var vm = this;
                this.workClickTl.play();
                this.particuleAnimLeave();
                this.$store.commit("setBack", false);
                this.workClickTl.eventCallback("onComplete", function () {
                    vm.workClickTl.kill();
                    vm.$router.push({
                        path: '/project/'
                    })
                });
            }, 

            gif(){
                const foo = document.querySelector('.bg-love');
                var gifLenght = foo.children.length;
                this.coverIndex++;
                var activeBg = document.querySelector('.cover-'+this.coverIndex);
                document.getElementsByClassName('bg-love-cover visible')[0].classList.remove("visible");
                activeBg.classList.add("visible");
                if(this.coverIndex >= foo.children.length){
                    this.coverIndex=0;
                }
            },
            particuleAnim(){
                function random(min, max) {
                    return Math.floor(Math.random() * (1 + max - min) + min);
                }
                var tlexplosion = gsap.timeline({});
                var num = 0;
                let vm = this;

                document.querySelector('.cursor-fx__inner__outside').classList.add('transparent');

                this.inter = window.setInterval(function () {
                    var typeParticule = random(1,12);
                    var div = document.createElement("div");
                    div.setAttribute("class", "sparkle part-" + num);
                    if((!vm.$device.ipad) && (!vm.$device.mobile)){
                        var particules = document.querySelector('.cursor-fx__inner__outside');
                    }else{
                        var particules = document.querySelector('.word-wrapper.word-wrapper-work:nth-child(1)');
                        particules.classList.add('overflow-visible');
                    }
                    particules.appendChild(div);
                    var lastPart = document.querySelector(".part-" + num);
                    lastPart.classList.add("sparkle-"+typeParticule);
                    createDot(lastPart)
                    num++
                },100); 

                function createDot(elem){
                    gsap.fromTo(elem, {
                        left: "+=" + random(-20,20) + "px",
                        top: "+=" + random(-20,20) + "px",
                        z: 0,
                        opacity: 1
                    }, {
                        duration: 1.25,
                        left: "+=" + random(-200,200) + "px",
                        top: "+=" + random(-200,200) + "px",
                        z: "+=" + random(-725,600),
                        opacity: 0,
                        ease: "power4.inOut"
                    });
                }
            },
            particuleAnimLeave(){
                let vm = this;
                clearInterval(this.inter);
                if((!vm.$device.ipad) && (!vm.$device.mobile)){

                    document.querySelector('.word-wrapper.word-wrapper-work:nth-child(1)').classList.remove('overflow-visible');
                }
                document.querySelector('.cursor-fx__inner__outside').classList.remove('transparent');
                setTimeout(function(){
                    document.querySelectorAll('.sparkle').forEach(
                        e => e.remove()
                    );
                }, 1500)
            },
            letterContainer(className){
                var word = document.getElementsByClassName(className)[0];
                var wordContent = word.textContent.trim();
                var wordContentSplit = wordContent.split("");
                word.innerHTML = "";

                for(var i=0; i< wordContentSplit.length; i++){
                    var newSpan = document.createElement('span');
                    newSpan.style.display = "inline-block";
                    newSpan.className = "staggerLetter";
                    if (wordContentSplit[i] == " "){
                        newSpan.style.width = "5px";
                    }
                    newSpan.innerHTML = wordContentSplit[i];
                    word.appendChild(newSpan);
                }
            }
        },
        mounted() {
            let vm = this;

            if(!this.$store.state.back){
                let vm = this;
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    vm.loveDownDown.play();
                    this.tlIntro
                        .from('.louise', {y: 230, duration: 2.5, ease: "power4.inOut" }, "intro")
                        .from('.margueritat', {y: 230, duration: 2.3, ease: "power4.inOut" }, "intro+=0.25")
                        .to('.intro .word-wrapper-elle', {left: -37, duration: 2.4, ease: "power4.inOut" }, "intro+=3")
                        .to('.intro .word-wrapper-aime', {left: 9, duration: 2.3, ease: "power4.inOut" }, "intro+=3")
                        .to('.intro .word-container .hide .hide-left', {width: 0, duration: 2.8, ease: "power4.inOut" }, "intro+=3");
                    this.tlIntro.eventCallback("onComplete", function () {
                        document.querySelector('.intro').style.display = "none";
                        document.getElementsByClassName("arrow")[0].classList.add("visible");
                        vm.scrollable = true;
                    });
                }else{
                    // this.tlIntro
                    //     .set('.intro .word-wrapper-elle, .intro .word-wrapper-aime', {opacity:1})
                    //     .fromTo('.intro .word-wrapper-elle', {x: "-200vw"},{x: "170vw", duration: 3, ease: "Linear.easeNone" }, "intro")
                    //     .fromTo('.intro .word-wrapper-aime', {x: "150vw"},{x: "-250vw", duration: 3, ease: "Linear.easeNone" }, "intro+=1");
                    // this.tlIntro.eventCallback("onComplete", function () {
                        document.querySelector('.intro').style.display = "none";
                        vm.loveDownDown.play();
                        document.querySelector('.circle-container.love').classList.add("visible");
                        document.getElementsByClassName("arrow")[0].classList.add("visible");
                        vm.scrollable = true;
                    // });
                }
            }else{
                let vm = this;
                vm.scrollable = true;
                console.log("play");
                document.querySelector('.work-container').classList.remove('visible');
                this.loveDownDown.play();
            }

            if((!this.$device.ipad) && (!this.$device.mobile)){
                this.loveShowContent
                    .to({}, 2.5, {})
                    .to(".love-content", {opacity:1, duration:1.2, ease: "power4.inOut" }, "loveShowContent")
                    .from(".marquee-text-text", {opacity:0, duration:1.5, ease: "power4.inOut" }, "loveShowContent")
                    .from(".love-description", {y: 20, opacity:0, duration: 1.8, ease: "power4.inOut" }, "loveShowContent+=0.8")
                    .from(".social-link", {y: 50, duration:1.5, ease: "power4.inOut"}, "loveShowContent+=1.3")
                    .from(".infos-link a", {y: 50, duration:1.5, ease: "power4.inOut"}, "loveShowContent+=1.8")
                    .from(".developped-link", {y: 50, duration:1.5, ease: "power4.inOut" }, "loveShowContent+=2.3");

                this.createAbout();
                this.letterContainer("about-block");
            }else{
                this.loveShowContent
                    .to({}, 2.5, {})
                    .to(".love-content", {opacity:1, duration:1.2, ease: "power4.inOut" }, "loveShowContent")
                    .from(".marquee-text-text", {opacity:0, duration:1.5, ease: "power4.inOut" }, "loveShowContent")
                    .from(".love-description", {y: 20, opacity:0, duration: 1.8, ease: "power4.inOut" }, "loveShowContent+=0.8")
                    .from(".infos-link a", {y: 80, duration:1.5, ease: "power4.inOut"}, "loveShowContent+=1.3")
                    .from(".social-link", {y: 80, duration:1.5, ease: "power4.inOut"}, "loveShowContent+=1.8")
                    .from(".developped-link", {y: 80, duration:1.5, ease: "power4.inOut" }, "loveShowContent+=2.3");
            }

            this.loveShowContent.eventCallback("onComplete", function () {
                document.querySelector('.cross').classList.add("active");
                document.querySelector('.developped').classList.add("overflow");
            });

            if((!this.$device.ipad) && (!this.$device.mobile)){
                this.LoveClickTl
                    .to(".word-wrapper-elle", {x:"-70vw", duration: 1.5, repeatRefresh: true, ease: "power4.inOut" }, "loveClickStart")
                    .to(".word-wrapper-aime", {x:"70vw", duration: 1.5, repeatRefresh: true, ease: "power4.inOut" }, "loveClickStart");
            }else{
                this.LoveClickTl
                    .to(".word-wrapper-elle", {x:"-80vw", duration: 1.75, repeatRefresh: true, ease: "power4.inOut" },"LoveClickTl")
                    .to(".word-wrapper-aime", {x:"80vw", duration: 1.75, repeatRefresh: true, ease: "power4.inOut" },"LoveClickTl");
            }


            for(let word of document.getElementsByClassName("about-block")){
                const letters = word.childNodes;
                for(let i=0; i<letters.length; i++ ){
                    var yValue= Math.floor(Math.random() * 10) + 1;
                    if(i % 2 == 0){
                        vm.hoverEffect.fromTo(letters[i], 1.8, {y: -yValue, opacity:0 },{y: 0, opacity:1, ease: Power4.easeInOut, overwrite: false}, "start");                
                    }else{
                        vm.hoverEffect.fromTo(letters[i], 1.8, {y: yValue, opacity:0 },{y: 0, opacity:1, ease: Power4.easeInOut, overwrite: false}, "start");                
                    }
                }
            }
            this.hoverEffect.pause(0);


            this.workClickTl
                .to(".word-wrapper-work:nth-child(1)", {x:"80vw", duration: 2, ease: "power4.inOut" },"workClickTl")
                .to(".word-wrapper-work:nth-child(2)", {x:"-80vw", duration: 2, ease: "power4.inOut" },"workClickTl+=0.1")
                .to(".word-wrapper-work:nth-child(3)", {x:"80vw", duration: 2, ease: "power4.inOut" },"workClickTl+=0.2")
                .to({}, 3, {});

            this.loveUpUp
                .fromTo(".elle", {y: 0},{y:-170, duration: 1, repeatRefresh: true, ease: "power4.inOut" },"loveUpUp")
                .fromTo(".aime", {y: 0},{y:-170, duration: 1, repeatRefresh: true, ease: "power4.inOut"},"loveUpUp+=0.25");

            this.loveUp
                .fromTo(".elle", {y: 0},{y:-170, duration: 1, repeatRefresh: true, ease: "power4.inOut" },"loveUpUp")
                .fromTo(".aime", {y: 0},{y:-170, duration: 1, repeatRefresh: true, ease: "power4.inOut"},"loveUpUp+=0.25");

            this.loveUpR
                .fromTo(".elle", {y: 170},{y:0, duration: 1, repeatRefresh: true, ease: "power4.inOut" },"loveUpUp")
                .fromTo(".aime", {y: 170},{y:0, duration: 1, repeatRefresh: true, ease: "power4.inOut"},"loveUpUp+=0.25");

            this.loveDown
                .fromTo(".aime", {y:0},{y: 170, duration: 1, repeatRefresh: true, ease: "power4.inOut" },"lmUp")
                .fromTo(".elle", {y:0},{y: 170, duration: 1, repeatRefresh: true, ease: "power4.inOut"},"lmUp+=0.25");

            this.loveDownDown
                .fromTo(".aime", {y:-170},{y:0, duration: 1, repeatRefresh: true, ease: "power4.inOut"},"lmUp")
                .fromTo(".elle", {y:-170},{y:0, duration: 1, repeatRefresh: true, ease: "power4.inOut" },"lmUp+=0.25");

            this.workUp
                .fromTo(".work", {y:170}, {y: 0, duration: 1, ease: "power4.inOut", stagger:0.3 },"workInit");

            this.workUpUp
                .fromTo(".work", {y: 0},{y: -170, duration: 1, ease: "power4.inOut", stagger:0.3 },"workInit");

            this.workDownDown
                .fromTo(".work", {y: -170},{y: 0, duration: 1, ease: "power4.inOut", stagger:-0.3 },"workInit");

            this.workDown
                .fromTo(".work", {y: 0},{y: 170, duration: 1, ease: "power4.inOut", stagger:-0.3 },"workInit");

            this.keySlide();
        }
    }
</script>

<style lang="scss" scoped>

    body{
        overflow: hidden;
    }

    .arrow{
        position: fixed;
        bottom: 55px;
        left: 50%;
        opacity: 0;
        transition: 0.5s ease;
        transform: translate(-50%, -50%);
        animation: upNdown 1s infinite alternate;
        z-index: 60;
        &.visible{
            opacity: 1;
            bottom: 45px;
            transition: 0.8s ease;
            transition-delay: 1s;
        }
        @keyframes upNdown {
            0% { transform: translate(-50%, 0); }
            100% { transform: translateY(-50%, -10px); }
        }
    }
    .intro{
        position: absolute;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #fff;
        z-index: 20;
        &.hide{
            display: none;
        }
        .word-container{
            &:hover{
                .word,
                .elle,
                .aime,
                .hide{
                    color: black;
                    .hide-left{
                        color: black;
                    }
                }
            }
            .word{
                line-height: 260px;
            }
            .word-wrapper-aime{
                top: -89px;
                left: 125px;
                @media ( max-width : 680px ) {
                    opacity: 0;
                }
            }
            .word-wrapper-elle{
                bottom: -88px;
                left: -79px;
                @media ( max-width : 680px ) {
                    opacity: 0;
                }
            }
            .hide{
                .hide-left{
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        }
    }

    .hold-on{
        display: none;
        -webkit-user-select: none; 
        -webkit-touch-callout: none; 
        -moz-user-select: none; 
        -ms-user-select: none; 
        user-select: none;    
        @media ( max-width : 780px ) {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            bottom: 80px;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 70px;
            margin: 0 auto;
            font-size: 12px;
            border: 1px solid #B4B3B1;
            border-radius: 200px;
            color: #B4B3B1;
            font-family: 'GTWalsheimProRegular';
            text-transform: uppercase;
            z-index: 999;
        }
    }
    .circle-container{
        display: inline-block;
        position: relative;
        display: flex;
        justify-content: center;
        display: none;
        -webkit-user-select: none; 
        -webkit-touch-callout: none; 
        -moz-user-select: none; 
        -ms-user-select: none; 
        user-select: none; 
        @media ( max-width : 780px ) {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            bottom: 130px;
            left: 50%;
            transform: translateX(-50%);
            width: 92px;
            height: 92px;
            margin: 0 auto;
            font-size: 12px;
            color: #B4B3B1;
            font-family: 'GTWalsheimProRegular';
            text-transform: uppercase;
            z-index: 9;
        } 
        svg{
            transform: scale(1);
            opacity: 1;
            transition: all 2s ease;
        }
        &.visible{
            .circle-text{
                transform: translate(0px, 0);
                transition: all 1.2s cubic-bezier(0.22, 0.61, 0.36, 1) .08s;
                transition-delay: 1.2s;


            }
            .circle{
                .foreground {
                    stroke-dashoffset: 0;
                    transform: rotate(-90deg);
                    transition: all 2s cubic-bezier(0.22, 0.61, 0.36, 1);
                    transition-delay: 2.5s;
                }
            }
        }
        &.hold{
            svg{
                transform: scale(2);
                opacity: 0;
                transition: all 5s ease-in;
            }
        }
        .hover-text-container{
            overflow: hidden;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .circle-text{
            color: #B4B3B1;
            font-family: sans-serif;
            transform: translate(0px, 25px);
            text-transform: uppercase;
            pointer-events: none;
            white-space: nowrap;
            -webkit-user-select: none; 
            -webkit-touch-callout: none; 
            -moz-user-select: none; 
            -ms-user-select: none; 
            user-select: none; 
            transition: all 2s cubic-bezier(0.22, 0.61, 0.36, 1);
        }
        .circle {
            height: 92px;
            width: 88px;
            .foreground {
                fill: transparent;
                stroke-dasharray: 377;
                stroke-dashoffset: 377;
                stroke: #B4B3B1;
                transform-origin: 50% 50%;
                transform: rotate(-90deg);
                transition: all 2s cubic-bezier(0.22, 0.61, 0.36, 1);
            }
        }
    }



    .homepage-container{
        position: relative;
        overflow: hidden;
        @media ( max-width : 680px ) {
            height: 100vh;
        }
        .work-container{
            position: absolute;
            top: 0;
            left: 0;
            display: none;
            &.visible{
                display: block;
                z-index: 50;
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
        z-index: 5;
        pointer-events: none;
        transition: all 1.4s cubic-bezier(.19,.77,.2,1);
        &.visible{
            opacity: 1;
            transition: all 1.4s cubic-bezier(.19,.77,.2,1);
        }
        img{
            width: 100%;
            height: 100vh;
            object-fit: cover;
            display: none;
            &.visible{
                display: block;
            }
        }
    }

    .home-slide-content{
        position: relative;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        // background: white;

        // &.red{
        //     background-color: red;
        // }
        // &.orange{
        //     background-color: orange;
        // }
    }
    .love-container{
        .word-container{
            z-index: 15;
        }
    }   
    .word-container{
        display: block;
        font-size: 200px;
        text-align: center;
        font-weight: bold;
        cursor: none!important;
        @media ( max-width : 680px ) {
            font-size: 130px;
            position: relative;
            top: -80px;
        }
        .elle,
        .aime{
            .hide{
                transition: all 1.4s cubic-bezier(.19,.77,.2,1);
                .hide-left,
                .hide-right{
                    transition: all 1.4s cubic-bezier(.19,.77,.2,1);
                }
            }
        }
        &.hover{
            .word,
            a{
                color: #FF9170;
                transition: all 0.9s cubic-bezier(.19,.77,.2,1);
            }
            .elle{
                color: #FF9170;
            }
            .aime{
                color: #FF9170;
            }
            .hide{
                color: #FF9170;
                transition: all 1.4s cubic-bezier(.19,.77,.2,1);
                .hide-right,
                .hide-left{
                    color: #FF9170;
                    transform: translateX(0);
                    opacity: 1;
                    transition: all 1.4s cubic-bezier(.19,.77,.2,1);
                }
            }
            .word-wrapper{
                &-elle{
                    left: -49px;
                    transition: all 1.4s cubic-bezier(.19,.77,.2,1);
                    transition: all 1.1s cubic-bezier(0.22, 0.61, 0.36, 1) .08s;
                }
                &-aime{
                    left: 60px;
                    transition: all 1.4s cubic-bezier(.19,.77,.2,1);
                    transition: all 1.1s cubic-bezier(0.22, 0.61, 0.36, 1) .08s;
                }
            }
            .word-wrapper-work{
                transition: all 1.05s cubic-bezier(.19,.77,.2,1);
                &:nth-child(1){
                    position: relative;
                    left: 73px;
                }
                &:nth-child(2){
                    position: relative;
                    left: -46px;
                }
                &:nth-child(3){
                    position: relative;
                    left: 2px;
                }
            }

        }
        &:hover{
            cursor: pointer;
            .word,
            a{
                color: #FF9170;
                transition: all 0.9s cubic-bezier(.19,.77,.2,1);
            }
            .hide{
                color: #FF9170;
                transition: all 1.4s cubic-bezier(.19,.77,.2,1);
                .hide-right,
                .hide-left{
                    color: #FF9170;
                    transform: translateX(0);
                    opacity: 1;
                    transition: all 1.4s cubic-bezier(.19,.77,.2,1);
                }
            }
            //ELLE AIME
            .word-wrapper{
                &-elle{
                    left: -79px;
                    // transition: all 1.4s cubic-bezier(.19,.77,.2,1);
                    transition: all 1.1s cubic-bezier(0.22, 0.61, 0.36, 1);
                    @media ( max-width : 680px ) {
                        left: -49px;
                    }
                }
                &-aime{
                    left: 125px;
                    // transition: all 1.4s cubic-bezier(.19,.77,.2,1);
                    transition: all 1.1s cubic-bezier(0.22, 0.61, 0.36, 1);
                    @media ( max-width : 680px ) {
                        left: 60px;
                    }
                }
            }
            .elle{
                color: #FF9170;
                transition: color 1.4s cubic-bezier(.19,.77,.2,1);
            }
            .aime{
                color: #FF9170;
                transition: color 1.4s cubic-bezier(.19,.77,.2,1);
            }

            //WORK
            .word-wrapper-work{
                transition: all 1.05s cubic-bezier(.19,.77,.2,1);
                &:nth-child(1){
                    position: relative;
                    left: -13px;
                }
                &:nth-child(2){
                    position: relative;
                    left: -83px;
                }
                &:nth-child(3){
                    position: relative;
                    left: 92px;
                }
            }
        }
        &.clicked{
            .elle{
                // left: -79px;
                // transform: translateX(-80vh);
                // transition: all 2s cubic-bezier(.19,.77,.2,1);

            }
            .aime{
                // transform: translateX(80vh);
                // left: 125px;
                // transition: all 2s cubic-bezier(.19,.77,.2,1);

            }
            .hide{
                .hide-right,
                .hide-left{
                    opacity: 1;
                    transform: translateX(0);
                }
            }
        }

        .word{
            display: flex;
            line-height: 160px;
            color: black;
        }
        .hide{
            width: auto;
            overflow: hidden;
            display: inline-block;
            color: black;
            .hide-right{
                color: black;
                transform: translateX(100%);
                opacity: 0;
            }
            .hide-left{
                color: black;
                transform: translateX(-100%);
                opacity: 0;
            }
        }
        .word-wrapper{
            overflow: hidden;
            &-elle{
                position: relative;
                bottom: -38px;
                left: -67px;
                transition: all 1s cubic-bezier(.19,.77,.2,1);
                @media ( max-width : 680px ) {
                    bottom: -48px;
                    left: -27px;
                }
            }
            &-aime{
                position: relative;
                top: -39px;
                left: -25px;
                transition: all 1s cubic-bezier(.19,.77,.2,1);
                @media ( max-width : 680px ) {
                    top: -58px;
                    left: 3px;
                }
            }
            &-about{
                font-size:18px;
                font-family    : 'GTWalsheimProMedium';
                margin-top: -5px;
                overflow: hidden;
            }
            &.overflow-visible{
                overflow: visible;
            }
        }
        //ELLE AIME

        //WORK
        .word-wrapper-work{
            transition: all 1.1s cubic-bezier(.19,.77,.2,1);
            transition: all 1.1s cubic-bezier(0.22, 0.61, 0.36, 1) .08s;

            &:nth-child(1){
                position: relative;
                bottom: -77px;
                left: 27px;
                @media ( max-width : 680px ) {
                    bottom: -106px;
                    left: 0px;
                }
            }
            &:nth-child(2){
                position: relative;
                left: 155px;
                @media ( max-width : 680px ) {
                    left: 71px;
                }
            }
            &:nth-child(3){
                position: relative;
                top: -73px;
                left: -79px;
                @media ( max-width : 680px ) {
                    top: -99px;
                    left: -82px;
                }
            }
        }
    }
</style>