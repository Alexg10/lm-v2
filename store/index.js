export const state = () => ({
    cover: null,
    back: false
})

export const mutations = {
    setCover(state, cover) {
        console.log(cover);
        state.cover = cover;
    },
    setBack(state, back) {
        console.log(back);
        state.back = back;
    }
}