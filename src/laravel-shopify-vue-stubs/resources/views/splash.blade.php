<style lang="text/css">
    @media (max-width: 768px) {
        .loading-sidebar {
            display: none !important;
        }

        .loading-avatar {
            background: #43467F !important;
        }
    }

    #booting {
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        background: #f4f6f8;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .loading-header {
        height: 56px;
        background: #1C2260;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .loading-searcher {
        flex: 2;
        display: block;
        height: 34px;
        max-width: 692px;
        margin: 30px 4px 30px 0;
        background: #43467F;
        border-radius: 3px;
    }

    .loading-avatar {
        display: block;
        height: 32px;
        width: 32px;
        margin: 16px 8px;
        background: #1C2260;
        border-radius: 32px;
    }

    .loading-body-wrapper {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        height: 100%;
    }

    .loading-sidebar {
        display: block;
        width: 240px;
        height: 100%;
        border-right: 1px solid #dfe3e8;
        padding: 16px 0
    }

    .loading-sidebar-row {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: 4px;
        height: 24px;
    }

    .loading-sidebar-icon {
        display: block;
        height: 23px;
        width: 23px;
        margin: 12px;
        background: #dfe3e8;
        border-radius: 3px;
    }

    .loading-sidebar-text {
        display: block;
        height: 15px;
        width: 52px;
        margin: 20px 0;
        background: #dfe3e8;
        border-radius: 3px;
    }

    .loading-body {
        flex: 2;
    }

    .loading-body-row {
        height: 52px;
        border-bottom: 1px solid #dfe3e8;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .loading-app-icon {
        display: block;
        height: 23px;
        width: 23px;
        margin: 16px 6px 16px 16px;
        background: #dfe3e8;
        border-radius: 3px;
    }

    .loading-app-name {
        display: block;
        height: 15px;
        width: 52px;
        margin: 20px 0;
        background: #dfe3e8;
        border-radius: 3px;
    }

    .filler {
        flex: 2;
    }

    .loading-tab-link {
        display: block;
        height: 12px;
        width: 60px;
        margin: 16px;
        background: #dfe3e8;
        border-radius: 3px;
    }

    .hidden {
        display: none;
    }
</style>

<div id="booting" class="hidden">
    <div class="loading-header">
        <div style="width: 52px"></div>
        <div class="loading-searcher"></div>
        <div class="loading-avatar"></div>
    </div>
    <div class="loading-body-wrapper">
        <div class="loading-sidebar">
            <div class="loading-sidebar-row">
                <div class="loading-sidebar-icon"></div>
                <div class="loading-sidebar-text"></div>
                <div class="filler"></div>
            </div>
            <div class="loading-sidebar-row">
                <div class="loading-sidebar-icon"></div>
                <div class="loading-sidebar-text"></div>
                <div class="filler"></div>
            </div>
            <div class="loading-sidebar-row">
                <div class="loading-sidebar-icon"></div>
                <div class="loading-sidebar-text"></div>
                <div class="filler"></div>
            </div>
        </div>
        <div class="loading-body">
            <div class="loading-body-row">
                <div class="loading-app-icon"></div>
                <div class="loading-app-name"></div>
                <div class="filler"></div>
            </div>
            <div class="loading-body-row">
                <div class="loading-tab-link"></div>
                <div class="loading-tab-link"></div>
                <div class="filler"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function inIframe () {
        try {
            return window.self !== window.top;
        } catch (e) {
            return true;
        }
    }

    if (!inIframe()) {
        document.getElementById('booting').classList.remove('hidden');
    }
</script>
