<template>
    <div class="love-content">
        <div class="cross link-hover" v-on:click="backHome" data-cursor-hover>
            <div class="crossLineOne">
                <div class="crossLineOne_content"></div>
            </div>
            <div class="crossLineTwo">
                <div class="crossLineTwo_content"></div>
            </div>
        </div>
        <div class="base-line-container">
            <marquee-text :repeat="2" :duration="20">
                <div class="base-line">images are stronger than words.</div>
            </marquee-text>
        </div>
        <div class="love-description">
            Oh, hi there!<br>
            I’m Louise Margueritat, 26, a french artistic director who would love to work with u.
            <div class="love-description-separator"></div>
        </div>
        <div class="bottom-container">
            <div class="left-bottom">
                <div class="contact-me infos-link">
                    <a href="https://nuxtjs.org" class="link link-hover" v-on:mouseenter="cocktailPlay" data-cursor-hover>
                        <div id="ico-cocktail" class="ico-anim"></div>
                        <p>contact me</p>
                    </a>
                </div>
                <div class="toppings-me infos-link">
                    <a href="" class="link link-hover" v-on:mouseenter="pizzaPlay" data-cursor-hover>
                        <div id="pizza-ico" class="ico-anim"></div>
                        <p>my toppings</p>
                    </a>
                </div>
            </div>
            <div class="right-bottom">
                <div class="developped">
                    <a href="https://twitter.com/AlexGuerard" class="developped-link link-hover" target="_blank" data-cursor-hover>
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
                loveContentLeave : gsap.timeline({paused: true}),
            }
        },
        methods: {
            backHome(){
                document.querySelector('.cross').classList.remove("active");
                this.loveContentLeave.pause(0);
                this.loveContentLeave.play();
                setTimeout(function(){
                    document.querySelector('.word-container').classList.remove("clicked");
                    document.querySelector('.love-content').classList.remove("visible");
                    document.querySelector('.circle-container').classList.add("visible");
                },3500);
            },
            cocktailPlay(){
                this.cocktailAnim.goToAndPlay(1,1);
            },
            pizzaPlay(){
                this.pizzaAnim.goToAndPlay(1,1);
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
                        newSpan.style.width = "7px";
                    }
                    newSpan.innerHTML = wordContentSplit[i];
                    word.appendChild(newSpan);
                }
            }
        },
        mounted() {
            if(!this.$device.mobile){
                this.loveContentLeave
                    .to(".infos-link a", {y: -50, duration:1.5, ease: "power4.inOut"}, "loveContentLeave")
                    .to(".developped-link", {y: -50, duration:1.5, ease: "power4.inOut"}, "loveContentLeave")
                    .to(".love-description", {y: -20, opacity:0, duration: 1.5, ease: "power4.inOut" }, "loveContentLeave+=0.4")
                    .to(".love-content", {opacity:0, duration:1, ease: "power4.inOut" }, "loveContentLeave+=0.8")
                    .to(".word-wrapper-elle", {x:"0", duration: 2, repeatRefresh: true, ease: "power4.inOut" },"loveContentLeave+=2")
                    .to(".word-wrapper-aime", {x:"0", duration: 2, repeatRefresh: true, ease: "power4.inOut" },"loveContentLeave+=2");
            }else{
                this.loveContentLeave
                    .to(".developped-link", {y: -80, duration:1.5, ease: "power4.inOut"}, "loveContentLeave")
                    .to(".infos-link a", {y: -80, duration:1.5, ease: "power4.inOut"}, "loveContentLeave+=0.3")
                    .to(".love-description", {y: -20, opacity:0, duration: 1.5, ease: "power4.inOut" }, "loveContentLeave+=0.6")
                    .to(".love-content", {opacity:0, duration:1, ease: "power4.inOut" }, "loveContentLeave+=1")
                    .to(".word-wrapper-elle", {x:"0", duration: 2, repeatRefresh: true, ease: "power4.inOut" },"loveContentLeave+=1.8")
                    .to(".word-wrapper-aime", {x:"0", duration: 2, repeatRefresh: true, ease: "power4.inOut" },"loveContentLeave+=1.8");
            }
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

            var staggerLink = document.querySelector('.developped-link');
            var tl = new TimelineMax();

            staggerLink.addEventListener('mouseenter', e => {
                tl.staggerFromTo(".staggerLetter", 0.45, { y: 0, ease: Power4.easeInOut },{ y: -15, ease: Power4.easeInOut }, 0.025)
                    .staggerFromTo(".staggerLetter", 0.45, { y: 20, ease: Power4.easeOut },{ y: 0, ease: Power4.easeInOut }, 0.025, "-=0.45");
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
        &.visible{
            visibility: visible;
            opacity   : 1;
            transition: opacity 1.1s cubic-bezier(.19,.77,.2,1);
        }
        .base-line{
            font-size: 190px;
            // color: $main-color;
            color        : #FF9170;
            white-space  : nowrap;
            line-height  : 270px;
            padding-right: 40px;
            margin-right : 40px;
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
            @media ( max-width : 680px ) {
                margin-bottom: 30px;
            }
        }
        .developped{
            @media ( max-width : 780px ) {
                width: 100%;
            }
            .developped-link{
                display: flex;            
                .ico-heart{
                    margin-right: 10px;
                    transition  : 0.5s ease;
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
            max-width      : 1180px;
            position       : fixed;
            bottom         : 90px;
            left           : 50%;
            transform      : translateX(-50%);
            padding        : 0 20px;
            @media ( max-width : 780px ) {
                flex-direction: column;
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
            }
            .left-bottom{
                display : flex;
                overflow: hidden;
                @media ( max-width : 780px ) {
                    justify-content: center;
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
                .contact-me{
                    font-family : 'GTWalsheimProMedium';
                    margin-right: 88px;
                    img{
                        width        : 45px;
                        margin-bottom: 20px;
                    }
                    a{
                        letter-spacing : 0.3px;
                        text-decoration: none;
                    }
                }
            }
            .right-bottom{
                display: flex;
                align-items: center;
            }
            .developped{
                font-family : 'GTWalsheimProMedium';
                font-size   : 18px;
                padding-left: 6px;
                overflow    : hidden;
                @media ( max-width : 780px ) {
                    transform: translateY(50px);
                }
                @media ( max-width : 680px ) {
                    width: 100%;

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
            @media ( max-width : 780px ) {
                margin-top : 45px;
                line-height: 40px;
                font-size  : 28px;
                max-width  : 415px;
                margin     : 0 auto;
            }
            @media ( max-width : 680px ) {
                margin-top : 45px;
                line-height: 28px;
                font-size  : 16px;
                max-width  : 300px;
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
    }
</style>