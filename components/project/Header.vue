<template>
    <div class="project-header">
        <img class="bg-cover" :src="cover.sourceUrl" alt="">
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
                    <a :href="link" target="_blank" class="project-link link linkHover link-stagger">View the website</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'title',
            'description',
            'type',
            'link',
            'cover'
        ]
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
    }
</style>