wp.blocks.registerBlockType("plugin/are-you-paying-attention", {
    title: "Are You Paying Attention?",
    icon: "smiley",
    category: "common",
    attributes: {

    },
    edit: function (props) {
        return (
            <>
               <p>paragraf test</p>
               <h4>heading 4</h4>
            </>
        )
    },
    save: function () {
        return null
    }
})