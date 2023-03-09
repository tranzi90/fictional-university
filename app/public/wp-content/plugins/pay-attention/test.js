wp.blocks.registerBlockType("plugin/are-you-paying-attention", {
    title: "Are You Paying Attention?",
    icon: "smiley",
    category: "common",
    edit: function () {
        return wp.element.createElement("h3", null, "Qq gg")
    },
    save: function () {
        return wp.element.createElement("h1", null, "This is the pizdec.")
    }
})