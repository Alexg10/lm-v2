<template>
    <div v-if="project">
        <h1>{{project.title}}</h1>
        <!-- {{project.acfProjectFields.blocs}} -->
        <div v-for="bloc in project.acfProjectFields.blocs" :key="bloc.fieldGroupName">
            <component :is="bloc.fieldGroupName.split('_').reverse().shift()" :bloc="bloc"/>
        </div>
    </div>
</template>

<script>
    // Queries
    import project from '~/queries/project'

    // Blocs
    import BlocStep from '~/blocs/BlocStep'
    import BlocTxt from '~/blocs/BlocTxt'
    import BlocLaptop from '~/blocs/BlocLaptop'
    import BlocSketch from '~/blocs/BlocSketch'
    import BlocImgFullCenter from '~/blocs/BlocImgFullCenter'
    import BlocImgFullHalf from '~/blocs/BlocImgFullHalf'
    import BlocBgGradient from '~/blocs/BlocBgGradient'
    import BlocColors from '~/blocs/BlocColors'
    import BlocSixImgTxt from '~/blocs/BlocSixImgTxt'
    import BlocPatchwork from '~/blocs/BlocPatchwork'
    import BlocAnimation from '~/blocs/BlocAnimation'
    import BlocAfterEffect from '~/blocs/BlocAfterEffect'
    import BlocFourSectionContent from '~/blocs/BlocFourSectionContent'


    export default {
        components: {
            BlocStep,
            BlocTxt,
            BlocLaptop,
            BlocSketch,
            BlocImgFullCenter,
            BlocImgFullHalf,
            BlocBgGradient,
            BlocColors,
            BlocSixImgTxt,
            BlocPatchwork,
            BlocAnimation,
            BlocAfterEffect,
            BlocFourSectionContent
        },
        apollo: {
            project : {
                prefetch : true,
                fetchPolicy: 'no-cache',
                query : project,
                variables(){
                    return {
                        slug : this.$route.params.slug
                    }
                },
                update: (data) => data.projectBy
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
