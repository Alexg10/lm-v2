<template>
    <div class="footer-project">
        <div class="foter-project-content">
            <!-- //TODO : CHANGE URL BY SLUG NEXT PROJECT -->
            <div @click="changeProject">
                <div class="link-to linkHover">
                    <div class="next-project up-letters">next project</div> 
                    <div class="next-project-name up-letters">{{link.acfProjectFields.projectTitle}}</div>
                    <img class="arrow" :src="arrowDown" alt="">
                </div>
                <div class="next-cover" :style="{ backgroundImage: `url(${link.acfProjectFields.headerPicture.sourceUrl})` }"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import arrowDown from '~/assets/images/ico/arrow-down-ico.svg'

    export default {
        data(){
            return{
                arrowDown
            }
        },
        props: [
            'link'
        ],
        methods: {
            changeProject() {
                // Set project to store
                this.$store.commit('setCover', this.link);

                // Animate out
                this.$router.push({
                    path: `/project/${this.link.slug}`
                })
            }
        },
    }
</script>

<style lang="scss" scoped>
    .footer-project{
        text-align: center;
        a{
            color: black;
            text-decoration: none;
            font-family: 'GTWalsheimProMedium';
            font-size: 16px;
            .next-project-name{
                margin-bottom: 20px;
            }
        }
        .arrow{
            margin-bottom: 100px;
        }
    }
    span{
        display: inline-block;
    }
    .next-cover{
        height: 100vh;
        width: 80%;
        margin: 0 auto;
        background-size: cover;
        background-position: 50%;
        z-index: 9999;
    }
</style>