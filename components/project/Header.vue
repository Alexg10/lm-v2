<template>
    <div class="project-header">
        <img class="bg-cover" :src="cover.sourceUrl" alt="">
        <div class="cross link-hover" v-on:mouseenter="crossHover" v-on:mouseleave="crossLeave" v-on:click="goToList">
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

                <div :class="title== 'Terres de Sable' ? 'project-name two-lines' : 'project-name'">
                    <div class="project-name-content">{{title}}</div>
                </div>
            </div>
            <div class="project-description">
                <p>{{description}}</p>
                <div v-if="link" class="link-container" >
                    <a :href="link" target="_blank" class="project-link link link-hover link-stagger">View the website</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import gsap from "gsap"

    export default {
        head () {
            return {
                title: `Louise Margueritat - ${this.title} project`,
                meta: [
                    { hid: 'description', name: 'description', content: `Louise Margueritat - Folio - ${this.title}` }
                ]
            }
        },
        data(){
            return{
                lastScrollTop : 0,
                winHeight :0
            }
        },
        props: [
            'title',
            'description',
            'type',
            'link',
            'cover'
        ],
        methods: {
            goToList(){
                let fromProject = this.$route.params.slug;
                this.$store.commit("fromProject", fromProject);
                document.querySelector('.cross').classList.remove("active");
                this.changeProject();
            },
            detectScroll(){
                const st = window.pageYOffset || document.documentElement.scrollTop;

                if(st>this.winHeight){
                    document.querySelector('.cross').classList.remove("active");
                    document.querySelector('.cross').classList.add("fixed");
                }else{
                    document.querySelector('.cross').classList.remove("active");
                    document.querySelector('.cross').classList.remove("fixed");
                }
                if (st < this.lastScrollTop){
                    document.querySelector('.cross').classList.add("active");
                }
                this.lastScrollTop = st <= 0 ? 0 : st;
            },
            changeProject() {
                this.$store.commit("setBack", true);
                this.$router.push({
                    path: `/project`
                })
            },
            letterContainer(className){
                var word             = document.getElementsByClassName(className)[0];
                var wordContent      = word.textContent.trim();
                var wordContentSplit = wordContent.split("");
                word.innerHTML       = "";

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
            },
            crossHover(){
                document.querySelector('.cursor').classList.add('hover');
            },
            crossLeave(){
                document.querySelector('.cursor').classList.remove('hover');
            },
        },
        mounted() {
            var vm = this;
            this.winHeight = window.innerHeight;

            window.addEventListener("scroll", this.detectScroll);

            const anim = gsap.timeline({});
            const sectionTl= new TimelineMax({ paused: false});
            const projectName = document.querySelector('.project-name-content');
            const projectNameH = projectName.offsetHeight;
            const categoryType = document.querySelector('.category-type');
            const description = document.querySelector('.project-description p');
            const link = document.querySelector('.project-link');
            const img = document.querySelector('.bg-cover');
            const scrollB = this.$scrollmagic;

            sectionTl.fromTo(img, 2,{y:0}, {y:200});

            const sceneParallax = scrollB.scene({
                triggerElement: '.bg-cover',
                triggerHook: 0,
                offset: 0,
                duration: 900
            })
            .setTween(sectionTl)
            scrollB.addScene(sceneParallax);

            if( link ){
                if(projectNameH > 261){
                    anim
                        .from(categoryType, {y: 50 , duration: 1.5 , ease: "power4.inOut"}, "fire")
                        .from(projectName, {y: 350,  duration: 3 , ease: "power4.inOut"},"-=0.7" )
                        .from(description, {y: 30, opacity:0, duration: 0.5 },"-=0.5" )
                        .from(link, {y:30, opacity:0, duration: 0.5  },"-=0.3" )
                        .set('.link-container',{overflow:"visible"});
                }else{
                    anim
                        .from(categoryType, {y: 50 , duration: 1.5 , ease: "power4.inOut"}, "fire")
                        .from(projectName, {y: 250,  duration: 1.6 , ease: "power4.inOut"},"-=0.9" )
                        .from(description, {y: 30, opacity:0, duration: 0.5 },"-=0.5" )
                        .from(link, {y:30, opacity:0, duration: 0.5 },"-=0.2" )
                        .set('.link-container',{overflow:"visible"});
                }

            }else{
                if(projectNameH > 200){
                    anim
                        .from(categoryType, {y: 50 , duration: 1.5 , ease: "power4.inOut"}, "fire")
                        .from(projectName, {y: 350,  duration: 1.8 , ease: "power4.inOut"},"-=0.9" )
                        .from(description, {y: 30, opacity:0, duration: 1 , ease: "power4.inOut"},"-=0.7" );
                }else{
                    anim
                        .from(categoryType, {y: 50 , duration: 1.5 , ease: "power4.inOut"}, "fire")
                        .from(projectName, {y: 230,  duration: 1.6 , ease: "power4.inOut"},"-=0.9" )
                        .from(description, {y: 30, opacity:0, duration: 0.8 , ease: "power4.inOut"},"-=0.5" );
                }
            }
            anim.eventCallback("onComplete", function () {
                document.querySelector('.cross').classList.add("active");
                if( link ){
                    document.querySelector('.project-link').classList.add("overflow");
                }

            });

            if(this.link){

                this.letterContainer("link-stagger");

                const staggerLink = document.querySelector('.project-link');
                const hoverEffect = new TimelineMax({ paused: false});

                for(let word of document.getElementsByClassName("project-link")){
                    const letters = word.childNodes;
                    for(let i=1; i<letters.length; i++ ){
                        var yValue= Math.floor(Math.random() * 12) + 1;
                        if(i % 2 == 0){
                            hoverEffect.fromTo(letters[i], 0.5, {y: 0},{y: -yValue, ease: Power4.easeInOut, overwrite: false}, "start");
                        }else{
                            hoverEffect.fromTo(letters[i], 0.5, {y: 0},{y: yValue, ease: Power4.easeInOut, overwrite: false}, "start");
                        }
                    }
                }

                hoverEffect.pause(0);
                staggerLink.addEventListener('mouseenter', e => {
                    hoverEffect.play(0);
                    document.querySelector('.cursor').classList.add('hover');

                });
                staggerLink.addEventListener('mouseleave', e => {
                    hoverEffect.play(1).reverse();
                    document.querySelector('.cursor').classList.remove('hover');

                });
            }
        },
        destroyed(){
            window.removeEventListener("scroll", this.detectScroll);
        }
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
            margin-bottom: 25px;
        }
        .project-name{
            font-size: 200px;
            font-weight: bold;
            overflow: hidden;
            line-height: 260px;
            &.two-lines{
                line-height: 170px;
                @media ( max-width : 780px ) {
                    line-height: 140px;
                }
                @media ( max-width : 680px ) {
                    line-height: 65px;
                }
            }
        }
        .project-description{
            position: relative;
            align-self: flex-end;
            max-width: 370px;
            font-size: 20px;
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
            padding: 2px 0 0;
            overflow: hidden;
            &.overflow{
                overflow: visible;
            }
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
                    position: initial;
                    top: 30%;
                }
            }
            .project-description{
                align-self: center;
                max-width: 90%;
                font-size: 19px;
                transform: translateY(0);
                position: absolute;
                left: 20px;
                bottom: 80px;
                padding-right: 20px;
            }
            .project-name{
                font-size: 65px;
                line-height: 85px;
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
