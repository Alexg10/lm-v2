<template>
        <div class="homepage-container">
            <div class="swiper-slide love-container">
                <div class="home-slide-content red">
                    <div class="bg-love">
                        <img class="bg-love-cover cover-1 visible" src="/images/home/lm_22.png" alt="">
                        <img class="bg-love-cover cover-2" src="/images/home/lm_1.jpg" alt="">
                        <img class="bg-love-cover cover-3" src="/images/home/lm_33.png" alt="">
                        <img class="bg-love-cover cover-4" src="/images/home/lm_44.png" alt="">
                        <img class="bg-love-cover cover-5" src="/images/home/lm_55.png" alt="">
                    </div>
                    <div class="love-content">
                        <div class="cross" v-on:click="backHome">
                            <div class="crossLineOne">
                                <div class="crossLineOne_content"></div>
                            </div>
                            <div class="crossLineTwo">
                                <div class="crossLineTwo_content"></div>
                            </div>
                        </div>
                        <div class="base-line-container">
                            <marquee-text :repeat="2" :duration="20">
                                <div class="base-line">images are stronger than words</div>
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
                                    <a href="https://nuxtjs.org" class="link" v-on:mouseenter="cocktailPlay">
                                        <div id="ico-cocktail" class="ico-anim"></div>
                                        <p>contact me</p>
                                    </a>
                                </div>
                                <div class="toppings-me infos-link">
                                    <a href="" class="link" v-on:mouseenter="pizzaPlay">
                                        <div id="pizza-ico" class="ico-anim"></div>
                                        <p>my toppings</p>
                                    </a>
                                </div>
                            </div>
                            <div class="right-bottom">
                                <div class="developped">
                                    <a href=""  class="developped-link">
                                        <div class="ico-heart">
                                            <img src="~/assets/images/ico/heart.svg" alt="">
                                        </div>
                                        <p>credits code by <span class="link-stagger">Alexandre Guerard</span></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="word-container link-hover" v-on:mouseenter="loveHover" v-on:mouseleave="loveLeave" v-on:click="loveClick">
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
                        <div class="word-container" v-on:mouseenter="workHover" v-on:mouseleave="particuleAnimLeave"  v-on:click="workClick">
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
    import MarqueeText from 'vue-marquee-text-component'
    import lottie from 'lottie-web'

    export default {
        components:{
            MarqueeText
        },
        data(){
            return{
                coverIndex: 1, 
                playing:'',
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
                this.playing = setInterval(() => {
                    this.gif();
                }, 250)
            },
            loveLeave(){
                document.querySelector('.bg-love').classList.remove("visible");
                clearInterval(this.playing);
            },
            loveClick(){
                this.LoveClickTl.play()
            },
            workHover(){
                this.particuleAnim()
            },
            workClick(){
                var vm=this;
                this.workClickTl.play();
                this.workClickTl.eventCallback("onComplete", function () {
                    vm.$router.push({
                        path: '/project/'
                    })
                });
            }, 
            loveClick(){
                document.querySelector('.word-container').classList.add("clicked");
                document.querySelector('.love-content').classList.add("visible");
                //TODO ADD 3SEC
                document.querySelector('.cross').classList.add("active");
            },
            backHome(){
                document.querySelector('.cross').classList.remove("active");
                document.querySelector('.word-container').classList.remove("clicked");
                document.querySelector('.love-content').classList.remove("visible");
            },
            cocktailPlay(){
                this.cocktailAnim.goToAndPlay(1,1);
            },
            pizzaPlay(){
                this.pizzaAnim.goToAndPlay(1,1);
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

                this.inter = window.setInterval(function () {
                    var typeParticule = random(1,12);
                    var div = document.createElement("div");
                    div.setAttribute("class", "sparkle part-" + num);
                    var particules = document.getElementById("cursor")[0];
                    document.querySelector("#cursor").appendChild(div);
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
                clearInterval(this.inter);
                setTimeout(function(){
                    document.querySelectorAll('.sparkle').forEach(
                        e => e.remove()
                    );
                }, 1500)
            }
        },
        mounted() {
            this.LoveClickTl.to(".elle", {x: "-80vw", duration: 1, ease: "power4.in"}, "fire")
                            .to(".aime", {x: "80vw", duration: 1, ease: "power4.in"}, "fire");

            this.workClickTl.to(".work:nth-child(1)", {x: "80vw", duration: 1, ease: "power4.in"}, "fire")
                            .to(".work:nth-child(2)", {x: "-80vw", duration: 1, ease: "power4.in"}, "fire+=0.1")
                            .to(".work:nth-child(3)", {x: "80vw", duration: 1, ease: "power4.in"}, "fire+=0.2");
            
            this.scrollSlide();
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
        }
    }
</script>

<style lang="scss" scoped>

    body{
        overflow: hidden;
    }

    .love-content{
        position: absolute;
        background: white;
        width: 100vw;
        height: 100vh;
        top: 0;
        left: 0;
        // display: none;
        font-size: 60px;
        text-align: center;
        font-weight: bold;
        overflow: hidden;
        visibility: hidden;
        z-index: 99;
        opacity: 0;
        transition: opacity 1.1s cubic-bezier(.19,.77,.2,1);
        &.visible{
            // display: block;
            visibility: visible;
            opacity: 1;
            transition: opacity 1.1s cubic-bezier(.19,.77,.2,1);
        }
        .base-line{
            font-size: 190px;
            // color: $main-color;
            color: #FF9170;
            white-space: nowrap;
            line-height: 270px;
            padding-right: 40px;
            margin-right: 40px;
            @media ( max-width : 680px ) {
                font-size: 78px;
                line-height: 100px;
            }
        }
        .base-line-container{
            display: block;
            width: 100vw;
            overflow: hidden;
            margin: 110px 0;
            @media ( max-width : 680px ) {
                margin-bottom: 30px;
            }
        }
        .developped-link{
            display: flex;            
            .ico-heart{
                margin-right: 10px;
                transition: 0.5s ease;
            }
            &:hover{
                .ico-heart{
                    animation: heart-beat 0.45s ease;
                }
            }
        }
        .bottom-container{
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1180px;
            position: fixed;
            bottom: 90px;
            left: 50%;
            transform: translateX(-50%);
            padding: 0 20px;
            @media ( max-width : 780px ) {
                flex-direction: column;
            }

            .ico-anim{
                max-width: 40px;
                margin-right: 17px;
                display: inline-block;
                float: left;
                @media ( max-width : 780px ) {
                        max-width: 60px;
                }
            }
            .left-bottom{
                display: flex;
                overflow: hidden;
                @media ( max-width : 780px ) {
                    justify-content: center;
                }
                a{
                    display: flex;
                    align-items: center;
                    // color: $main-color;
                    color: #FF9170;
                    text-decoration: none;
                    font-family: 'GTWalsheimProMedium';
                    font-size: 18px;
                    @media ( max-width : 780px ) {
                        justify-content: center;
                        flex-direction: column;
                    }
                }
                p{
                    display: flex;
                }
                .contact-me{
                    font-family: 'GTWalsheimProMedium';
                    margin-right: 88px;
                    img{
                        width: 45px;
                        margin-bottom: 20px;
                    }
                    a{
                        letter-spacing: 0.3px;
                        text-decoration: none;
                    }
                }
            }
            .right-bottom{
                display: flex;
                align-items: center;
            }
            .developped{
                font-family: 'GTWalsheimProMedium';
                font-size: 18px;
                padding-left: 6px;
                overflow: hidden;
                @media ( max-width : 780px ) {
                    transform: translateY(50px);
                }
                a{
                    color: black;
                    text-decoration: none;
                    font-size: 14px;
                    line-height: 22px;
                    @media ( max-width : 780px ) {
                        justify-content: center;
                    }
                }
                span{
                    font-weight: bold;
                    position: relative;
                    overflow: hidden;
                }
                .ico-heart{
                    display: flex;
                }
            }
        }
        .love-description-separator{
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            height: 1px;
            width: 20px;
            background-color: black;
        }
        .love-description{
            position: relative;
            font-size: 22px;
            font-family: 'GTWalsheimProMedium';
            font-weight: bold;
            max-width: 444px;
            line-height: 32px;
            margin: 0 auto;
            @media ( max-width : 780px ) {
                margin-top: 45px;
                line-height: 40px;
                font-size: 28px;
                max-width: 415px;
                margin: 0 auto;
            }
            @media ( max-width : 680px ) {
                margin-top: 45px;
                line-height: 28px;
                font-size: 16px;
                max-width: 300px;
            }
        }
        .word-container{
            line-height: 80px;
            @media ( max-width : 780px ) {
                font-size: 50px;
                line-height: 50px;
                letter-spacing: -1.3px;
                max-width: 80%;
                margin: 0 auto;
            }
            @media ( max-width : 680px ) {
                line-height: 48px;
            }
        }
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
        pointer-events: none;
        transition: all 0.9s cubic-bezier(.19,.77,.2,1);
        &.visible{
            opacity: 1;
            transition: all 0.9s cubic-bezier(.19,.77,.2,1);
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
        font-size: 200px;
        text-align: center;
        font-weight: bold;
        background: white;
        &.red{
            // background-color: red;
        }
        &.orange{
            // background-color: orange;
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
            &.clicked{
                .elle{
                    left: -79px;
                    transform: translateX(-80vh);
                    transition: all 2s cubic-bezier(.19,.77,.2,1);

                }
                .aime{
                    transform: translateX(80vh);
                    left: 125px;
                    transition: all 2s cubic-bezier(.19,.77,.2,1);

                }
                .hide{
                    .hide-right,
                    .hide-left{
                        transform: translateX(0);
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






    .cross{
		position: absolute;
        top: 15px;
        left: 50%;
		width: 40px;
		height: 40px;
		// border: 1px solid black;
		// border-radius: 100px;
        transform: translateX(-50%);
		&:hover{
			cursor: pointer;
		}
		&.active{
			.crossLineOne{
				.crossLineOne_content{
					transform: translate(0%, 0%);
					transition: 0.4s ease;
					transition-delay:0.3s;
				}
			}
			.crossLineTwo{
				.crossLineTwo_content{
					transform: translate(0%, 0%);
					transition: 0.4s ease;
				}
			}
		}
	}
	.crossLineOne{
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 2px;
        transform: translate(-50%,-50%) rotate(-45deg);
        overflow: hidden;
		&_content{
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: #3b4046;
			transform: translate(100%, 0%);
			transition: 0.4s ease;
			transition-delay:0.3s;
		}
	}
	.crossLineTwo{
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 2px;
        transform: translate(-50%,-50%) rotate(45deg);
        overflow: hidden;
		&_content{
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: #3b4046;
			transform: translate(-100%, 0%);
			transition: 0.4s ease;
		}
	}
</style>