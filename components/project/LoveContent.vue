<template>
    <div class="love-content">
        <div class="cross link-hover" v-on:click="backHome" v-on:mouseenter="linkHover" v-on:mouseleave="linkLeave">
            <div class="crossLineOne">
                <div class="crossLineOne_content"></div>
            </div>
            <div class="crossLineTwo">
                <div class="crossLineTwo_content"></div>
            </div>
        </div>
        <div class="base-line-container">
            <marquee-text :repeat="2" :duration="20">
                <div class="base-line">Let's share a pizza!</div>
            </marquee-text>
        </div>
        <div class="love-description">
            Oh, hi there!<br>
            I’m Louise Margueritat, 26, a french art director who would love to work with u.
            <div class="go-to-work" v-on:mouseenter="linkHover" v-on:mouseleave="linkLeave" v-on:click="goToWork">See my projects</div> 
        </div>
        <div class="bottom-container">
            <div class="left-bottom">
                <ul class="social-links">
                    <li class="social-link">
                        <a href="https://www.instagram.com/loumargueritat/" v-on:mouseenter="socialHover" v-on:mouseleave="socialLeave">I<span>ns</span>t<span>a</span>g<span>ram</span>.</a>
                    </li>
                    <li class="social-link">
                        <a href="https://www.linkedin.com/in/louise-margueritat-16857786/" v-on:mouseenter="socialHover" v-on:mouseleave="socialLeave">L<span>in</span>k<span>e</span>d<span>in</span>.</a>
                    </li>
                    <li class="social-link">
                        <a href="https://www.behance.net/louiseArtLove/" v-on:mouseenter="socialHover" v-on:mouseleave="socialLeave">B<span>e</span>h<span>an</span>c<span>e</span>.</a>
                    </li>
                </ul>
            </div>
            <div class="center-bottom">
                <div class="contact-me infos-link">
                    <a href="mailto:margueritatlouise@gmail.com" class="link link-hover" v-on:mouseenter="cocktailPlay"  v-on:mouseleave="linkLeave">
                        <div id="ico-cocktail" class="ico-anim"></div>
                        <p>contact me</p>
                    </a>
                </div>
                <div class="toppings-me infos-link">
                    <a href="http://api.louise-margueritat.love/cv.pdf" target="_blank" class="link link-hover" v-on:mouseenter="pizzaPlay"  v-on:mouseleave="linkLeave">
                        <div id="pizza-ico" class="ico-anim"></div>
                        <p>my toppings</p>
                    </a>
                </div>
            </div>
            <div class="right-bottom">
                <div class="developped">
                    <a href="https://twitter.com/AlexGuerard" class="developped-link link-hover" target="_blank" v-on:mouseenter="linkHover" v-on:mouseleave="linkLeave">
                        <div class="ico-heart">
                            <img src="~/assets/images/ico/heart.svg" alt="">
                        </div>
                        <p>credits code by <span class="link-stagger">Alexandre Guerard</span></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MarqueeText from 'vue-marquee-text-component'
    import lottie from 'lottie-web'
    import gsap from 'gsap'

    export default {
        components:{
            MarqueeText
        },
        data(){
            return{
                loveContentLeave: gsap.timeline({paused: true}),
                loveContentFade : gsap.timeline({paused: true}),
                hoverEffectWork : new TimelineMax({ paused: false})
            }
        },
        methods: {
            backHome(){
                const vm = this;
                document.querySelector('.cross').classList.remove("active");
                document.querySelector('.developped').classList.remove("overflow");
                this.loveContentLeave.pause(0);
                this.loveContentLeave.play();
                setTimeout(function(){
                    if((!vm.$device.ipad) && (!vm.$device.mobile)){
                        document.querySelector('.word-container').classList.remove("clicked");
                    }
                    document.querySelector('.home-slide-content .word-wrapper-elle').classList.remove("anim");
                    document.querySelector('.home-slide-content .word-wrapper-aime').classList.remove("anim");
                    document.querySelector('.love-content').classList.remove("visible");
                    document.querySelector('.developped').classList.remove("overflow");
                    document.querySelector('.circle-container').classList.add("visible");
                },3500);
            },
            goToWork(){
                const vm = this;
                this.hoverEffectWork.pause(1);
                document.querySelector('.cross').classList.remove("active");
                document.querySelector('.developped').classList.remove("overflow");
                this.loveContentFade.pause(0);
                this.loveContentFade.play();
                this.loveContentFade.eventCallback("onComplete", function () {
                    vm.$router.push({
                        path: '/project/'
                    })
                })
            },
            cocktailPlay(){
                const vm = this;
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    vm.linkHover();
                    this.cocktailAnim.goToAndPlay(1,1);
                }
            },
            pizzaPlay(){
                const vm = this;
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    vm.linkHover();
                    this.pizzaAnim.goToAndPlay(1,1);
                }
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
            },
            childNodes(){
                for (let link of document.getElementsByClassName("social-link")){
                    const spans = link.querySelectorAll("span");
                    for (let span of spans){
                        const spanW = span.offsetWidth;
                        spanW= spanW +1;
                        span.dataset.width = spanW;
                        span.style.width = 0;
                    }
                }
            },
            socialHover(e){
                let el = e.target
                let spans = el.querySelectorAll("span");
                this.linkHover();

                for (let span of spans){
                    const spanWDeployed = span.dataset.width;
                    span.style.width = spanWDeployed+"px";
                }
            },
            socialLeave(e){
                let el = e.target
                let spans = el.querySelectorAll("span");
                this.linkLeave();
                for (let span of spans){
                    span.style.width = 0+"px";;
                }
            },
            linkHover(){
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    document.querySelector('.cursor').classList.add('hover'); 
                }
            },
            linkLeave(){
                if((!this.$device.ipad) && (!this.$device.mobile)){
                    document.querySelector('.cursor').classList.remove('hover'); 
                }
            },
        },
        mounted() {
            if((!this.$device.ipad) && (!this.$device.mobile)){
                this.childNodes();
            }
            const vm = this;

            if(!this.$device.mobile){
                this.loveContentLeave
                    .to(".infos-link a", {y: -50, duration:1.5, ease: "power4.inOut"}, "loveContentLeave")
                    .to(".developped-link", {y: -50, duration:1.5, ease: "power4.inOut"}, "loveContentLeave")
                    .to(".social-link", {y: -50, duration:1.5, ease: "power4.inOut"}, "loveContentLeave")
                    .to(".love-description", {y: -20, opacity:0, duration: 1.5, ease: "power4.inOut" }, "loveContentLeave+=0.4")
                    .to(".love-content", {opacity:0, duration:1, ease: "power4.inOut" }, "loveContentLeave+=0.8");
            }else{
                this.loveContentLeave
                    .to(".developped-link", {y: -80, duration:1.5, ease: "power4.inOut"}, "loveContentLeave")
                    .to(".infos-link a", {y: -80, duration:1.5, ease: "power4.inOut"}, "loveContentLeave+=0.3")
                    .to(".social-link", {y: -80, duration:1.5, ease: "power4.inOut"}, "loveContentLeave")
                    .to(".love-description", {y: -20, opacity:0, duration: 1.5, ease: "power4.inOut" }, "loveContentLeave+=0.6")
                    .to(".love-content", {opacity:0, duration:1, ease: "power4.inOut" }, "loveContentLeave+=1");
            }
            this.loveContentLeave.eventCallback("onComplete", function () {
                document.querySelector('.work-container .word-container').classList.remove("hover");
            });


            this.loveContentFade
                    .to(".infos-link a", {y: -50, duration:1.5, ease: "power4.inOut"}, "loveContentLeave")
                    .to(".developped-link", {y: -50, duration:1.5, ease: "power4.inOut"}, "loveContentLeave")
                    .to(".love-description", {y: -20, opacity:0, duration: 1.5, ease: "power4.inOut" }, "loveContentLeave+=0.4")
                    .to(".love-content", {opacity:0, duration:1, ease: "power4.inOut" }, "loveContentLeave+=0.8")
                    .to(".arrow", {opacity:0, duration: 0.5, ease: "power4.inOut" }, "loveContentLeave");

            //* LOTTIE ANIMATION
            this.pizzaAnim = lottie.loadAnimation({
                container: document.getElementById('pizza-ico'),
                renderer: 'svg',
                loop: false,
                autoplay: false,
                path: "/images/anim_img/pizza.json" 
            });
            this.pizzaAnim.goToAndStop(70,1);

            this.cocktailAnim = lottie.loadAnimation({
                container: document.getElementById('ico-cocktail'),
                renderer: 'svg',
                loop: false,
                autoplay: false,
                path: "/images/anim_img/cocktail.json" 
            });
            this.cocktailAnim.goToAndStop(75,1);
            //* END LOTTIE ANIMATION

            this.letterContainer("link-stagger");
            this.letterContainer("go-to-work");

            const staggerLink = document.querySelector('.developped-link');
            const workLink = document.querySelector('.go-to-work');

            const hoverEffect = new TimelineMax({ paused: false});

            for(let word of document.getElementsByClassName("link-stagger")){
                const letters = word.childNodes;
                for(let i=1; i<letters.length; i++ ){
                    const yValue= Math.floor(Math.random() * 10) + 1;
                    if(i % 2 == 0){
                        hoverEffect.fromTo(letters[i], 0.5, {y: 0},{y: -yValue, ease: Power4.easeInOut, overwrite: false}, "start");                
                    }else{
                        hoverEffect.fromTo(letters[i], 0.5, {y: 0},{y: yValue, ease: Power4.easeInOut, overwrite: false}, "start");                
                    }
                }
            }

            for(let word of document.getElementsByClassName("go-to-work")){
                const letters = word.childNodes;
                for(let i=1; i<letters.length; i++ ){
                    const yValue= Math.floor(Math.random() * 10) + 1;
                    if(i % 2 == 0){
                        vm.hoverEffectWork.fromTo(letters[i], 0.5, {y: 0},{y: -yValue, ease: Power4.easeInOut, overwrite: false}, "start");                
                    }else{
                        vm.hoverEffectWork.fromTo(letters[i], 0.5, {y: 0},{y: yValue, ease: Power4.easeInOut, overwrite: false}, "start");                
                    }
                }
            }

            hoverEffect.pause(0);
            this.hoverEffectWork.pause(0);

            staggerLink.addEventListener('mouseenter', e => {
                hoverEffect.play(0);
            });    
            staggerLink.addEventListener('mouseleave', e => {
                hoverEffect.play(1).reverse();
            });  

            workLink.addEventListener('mouseenter', e => {
                vm.hoverEffectWork.play(0);
            });    
            workLink.addEventListener('mouseleave', e => {
                vm.hoverEffectWork.play(1).reverse();
            });  
        },
    }
</script>

<style lang="scss" scoped>
    .love-content{
        position   : absolute;
        background : white;
        width      : 100vw;
        height     : 100vh;
        top        : 0;
        left       : 0;
        font-size  : 60px;
        text-align : center;
        font-weight: bold;
        overflow   : hidden;
        visibility : hidden;
        z-index    : 99;
        opacity    : 0;
        transition : opacity 1.1s cubic-bezier(.19,.77,.2,1);
        -webkit-user-select: none; 
        -webkit-touch-callout: none; 
        -moz-user-select: none; 
        -ms-user-select: none; 
        user-select: none;
        &.visible{
            visibility: visible;
            opacity   : 1;
            transition: opacity 1.1s cubic-bezier(.19,.77,.2,1);
        }
        .base-line{
            font-size: 190px;
            font-size: 11vw;
            // color: $main-color;
            color        : #FF9170;
            white-space  : nowrap;
            line-height  : 270px;
            padding-right: 40px;
            margin-right : 40px;
            @media ( min-width : 1500px ) {
                font-size: 190px;
            }
            @media ( max-width : 680px ) {
                font-size  : 78px;
                line-height: 100px;
            }
        }
        .base-line-container{
            display : block;
            width   : 100vw;
            overflow: hidden;
            margin  : 110px 0;
            margin: 4vh 0;
            @media ( min-width : 1500px ) {
                margin  : 110px 0;
            }
            @media ( max-width : 680px ) {
                margin-top: 80px;
                margin-bottom: 30px;
            }
        }

        .go-to-work{
            font-size: 18px;
            margin-top: 28px;
            -webkit-user-select: none; 
            -webkit-touch-callout: none; 
            -moz-user-select: none; 
            -ms-user-select: none; 
            user-select: none; 
            @media ( max-width : 680px ) {
                font-size: 16px;
            }
        }
        .developped{
            span{
                font-family: 'GTWalsheimProRegular';
            }
            @media ( max-width : 780px ) {
                width: 100%;
            }
            .developped-link{
                display: flex;            
                .ico-heart{
                    margin-right: 10px;
                    transition  : 0.5s ease;
                    @media ( max-width : 780px ) {
                        transform: scale(0.8);
                        animation: heart-beat-mobile 5s ease;
                        animation-iteration-count: infinite;
                    }
                }
                &:hover{
                    .ico-heart{
                        animation: heart-beat 0.45s ease;
                    }
                }
                p{
                    overflow: hidden;
                }
            }
        }
        .bottom-container{
            display        : flex;
            justify-content: space-between;
            width          : 100%;
            max-width      : 1200px;
            position       : fixed;
            bottom         : 90px;
            bottom         : 7vh;
            left           : 50%;
            transform      : translateX(-50%);
            padding        : 0 20px;
            @media ( max-width : 780px ) {
                flex-direction: column;
                bottom : 11vh;
            }
            @media ( max-width : 780px ) {
                bottom : 4vh;
            }

            .ico-anim{
                max-width   : 40px;
                margin-right: 17px;
                display     : inline-block;
                float       : left;
                @media ( max-width : 780px ) {
                    max-width: 60px;
                }
                @media ( max-width : 780px ) {
                    max-width: 50px;
                    &#pizza-ico{
                        max-width : 40px;
                        min-height: 59px;
                    }
                }
                @media ( max-width : 680px ) {
                    margin-right: 0px;
                }

            }
            .center-bottom,
            .left-bottom{
                display : flex;
                overflow: hidden;
                -webkit-user-select: none; 
                -webkit-touch-callout: none; 
                -moz-user-select: none; 
                -ms-user-select: none; 
                user-select: none;
                @media ( max-width : 780px ) {
                    justify-content: center;
                    order: 2;
                    margin-bottom: 30px;
                }
                a{
                    display    : flex;
                    align-items: center;
                    // color: $main-color;
                    color          : #FF9170;
                    text-decoration: none;
                    font-family    : 'GTWalsheimProMedium';
                    font-size      : 18px;
                    @media ( max-width : 780px ) {
                        justify-content: center;
                        flex-direction: column;
                    }
                    @media ( max-width : 680px ) {
                        font-size: 16px;
                    }
                }
                p{
                    display: flex;
                }
                .toppings-me{
                    display: flex;
                    .ico-anim{
                        max-width: 33px;
                    }
                }
                .social-links{
                    display: flex;
                    align-items: center;
                    padding: 0;
                    overflow: hidden;
                    li{
                        display: flex;
                        justify-content: center;
                        list-style-type: none;
                        min-width: 85px;
                        height: 20px;
                        text-align: center;
                        font-size: 14px;
                        -webkit-user-select: none; 
                        -webkit-touch-callout: none; 
                        -moz-user-select: none; 
                        -ms-user-select: none; 
                        user-select: none; 
                        @media ( max-width : 780px ) {
                            min-width: 195px;
                        }
                        @media ( max-width : 680px ) {
                            min-width: 105px;
                        }
                        a{
                            color: black;
                            font-size: 14px;
                            text-align: center;
                            @media ( max-width : 780px ) {
                                flex-direction: row;
                                font-size: 16px;
                            }
                            @media ( max-width : 680px ) {
                                font-size: 14px
                            }
                        }
                        span{
                            overflow: hidden;
                            transition: width 0.6s ease;
                        }
                        &:hover{
                            span{
                                overflow: hidden;
                            } 
                        }
                    }
                }
                .contact-me{
                    font-family : 'GTWalsheimProMedium';
                    margin-right: 88px;
                    -webkit-user-select: none; 
                    -webkit-touch-callout: none; 
                    -moz-user-select: none; 
                    -ms-user-select: none; 
                    user-select: none;
                    @media ( max-width : 780px ) {
                        margin-right: 148px;
                    }
                    @media ( max-width : 680px ) {
                        margin-right: 88px;
                    }

                    img{
                        width        : 45px;
                        margin-bottom: 20px;
                    }
                    a{
                        letter-spacing : 0.3px;
                        text-decoration: none;
                        -webkit-user-select: none; 
                        -webkit-touch-callout: none; 
                        -moz-user-select: none; 
                        -ms-user-select: none; 
                        user-select: none;
                    }
                }
            }
            .center-bottom{
                @media ( max-width : 780px ) {
                    order: 1;
                    margin-bottom: 200px;
                }
                @media ( max-width : 680px ) {
                    margin-bottom: 45px;
                }

            }
            .right-bottom{
                display: flex;
                align-items: center;
                @media ( max-width : 780px ) {
                    order: 3
                }
            }
            .developped{
                font-family : 'GTWalsheimProMedium';
                font-size   : 18px;
                padding-left: 6px;
                overflow    : hidden;
                &.overflow{
                    overflow: visible;   
                    p{
                        overflow: visible;   
                    }
                }
                @media ( max-width : 780px ) {
                    transform: translateY(50px);

                }
                @media ( max-width : 680px ) {
                    width: 100%;
                    transform: translateY(0);
                }
                a{
                    color          : black;
                    text-decoration: none;
                    font-size      : 14px;
                    line-height    : 22px;
                    padding        : 5px 0 15px;
                    margin-top     : 10px;
                    @media ( max-width : 780px ) {
                        justify-content: center;
                        font-size   : 16px;
                    }
                    @media ( max-width : 780px ) {
                        font-size   : 14px;
                    }
                }
                span{
                    font-weight: bold;
                    position   : relative;
                    overflow   : hidden;
                }
                .ico-heart{
                    display: flex;
                }
            }
        }
        .love-description-separator{
            position        : absolute;
            bottom          : -20px;
            left            : 50%;
            transform       : translateX(-50%);
            height          : 1px;
            width           : 20px;
            background-color: black;
        }
        .love-description{
            position   : relative;
            font-size  : 22px;
            font-family: 'GTWalsheimProMedium';
            font-weight: bold;
            max-width  : 444px;
            line-height: 32px;
            margin     : 0 auto;
            -webkit-user-select: none; 
            -webkit-touch-callout: none; 
            -moz-user-select: none; 
            -ms-user-select: none; 
            user-select: none; 
            @media ( max-width : 780px ) {
                margin-top : 45px;
                line-height: 30px;
                font-size: 23px;
                max-width  : 455px;
                margin     : 0 auto;
            }
            @media ( max-width : 680px ) {
                margin-top : 45px;
                max-width  : 300px;
                line-height: 24px;
                font-size: 18px;
            }
        }
        .word-container{
            line-height: 80px;
            @media ( max-width : 780px ) {
                font-size     : 50px;
                line-height   : 50px;
                letter-spacing: -1.3px;
                max-width     : 80%;
                margin        : 0 auto;
            }
            @media ( max-width : 680px ) {
                line-height: 48px;
            }
        }



        @keyframes heart-beat {
            0%{
                transform: scale(1);
            }
            50%{
                transform: scale(1.5);
            }
            100%{
                transform: scale(1);
            }
        }
        @keyframes heart-beat-mobile {
            0%{
                transform: scale(0.8);
            }
            10%{
                transform: scale(0.8);
            }
            20%{
                transform: scale(1.1);
            }
            30%{
                transform: scale(0.8);
            }
        }
    }
</style>