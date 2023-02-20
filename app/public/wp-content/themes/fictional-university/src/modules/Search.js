import $ from "jquery"

class Search {
    constructor() {
        this.addSearchHTML()

        this.openButton = $(".js-search-trigger")
        this.closeButton = $(".search-overlay__close")
        this.searchOverlay = $(".search-overlay")
        this.searchField = $("#search-term")
        this.searchResult = $("#search-overlay__results")

        this.events()

        this.isOverlayOpen = false
        this.isSpinnerVisible = false
        this.typingTimer
        this.previousValue
    }

    events() {
        this.openButton.on("click", this.openOverlay.bind(this))
        this.closeButton.on("click", this.closeOverlay.bind(this))
        $(document).on("keydown", this.keyPressDispatcher.bind(this))
        this.searchField.on("keyup", this.typingLogic.bind(this))
    }

    typingLogic() {
        if (this.searchField.val() !== this.previousValue) {
            clearTimeout(this.typingTimer)

            if (this.searchField.val()) {
                if (!this.isSpinnerVisible) {
                    this.searchResult.html('<div class="spinner-loader"></div>')
                    this.isSpinnerVisible = true
                }

                this.typingTimer = setTimeout(this.getResults.bind(this), 750)
            }
            else {
                this.searchResult.html('')
                this.isSpinnerVisible = false
            }
        }

        this.previousValue = this.searchField.val()
    }

    getResults() {
        $.when(
            $.getJSON(`${universityData.root_url}/wp-json/wp/v2/posts?search=${this.searchField.val()}`),
            $.getJSON(`${universityData.root_url}/wp-json/wp/v2/pages?search=${this.searchField.val()}`)
        ).then((posts, pages) => {
            const combinedResults = posts[0].concat(pages[0])

            this.searchResult.html(`
                    <h2 class="headline headline--medium headline--post-title">General Information</h2>
                    ${combinedResults.length ? '<ul class="link-list min-list">' : '<p>No results...</p>'}
                        ${combinedResults.map(item => `
                            <li>
                                <a href="${item.link}">${item.title.rendered}</a>
                                ${item.type === 'post' ? `by ${item.authorName}` : ''} 
                            </li>
                        `).join('')}
                    ${combinedResults.length ? '</ul>' : ''}  
                `)
            this.isSpinnerVisible = false
        }, () => this.searchResult.html('<p>Error reject cb</p>'))
    }

    keyPressDispatcher(e) {
        if (e.keyCode === 83 && !this.isOverlayOpen)
            this.openOverlay()

        if (e.keyCode === 27 && this.isOverlayOpen)
            this.closeOverlay()
    }

    openOverlay() {
        this.searchOverlay.addClass("search-overlay--active")
        $("body").addClass("body-no-scroll")

        this.isOverlayOpen = true
    }

    closeOverlay() {
        this.searchOverlay.removeClass("search-overlay--active")
        $("body").removeClass("body-no-scroll")

        this.isOverlayOpen = false
    }

    addSearchHTML() {
        $("body").append(`
            <div class="search-overlay">
                <div class="search-overlay__top">
                    <div class="container">
                        <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                        <input type="text"
                               class="search-term"
                               id="search-term"
                               placeholder="What u need?">
                        <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
                    </div>
                </div>

                <div class="container">
                    <div id="search-overlay__results"></div>
                </div>
            </div>
        `)
    }
}

export default Search