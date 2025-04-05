<div>
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
    <div class="two-column-layout">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/3 px-4">
                    <!-- Left Column -->
                    {{ $left }}
                </div>
                <div class="w-full md:w-2/3 px-4">
                    <!-- Right Column -->
                    {{ $right }}
                </div>
            </div>
        </div>
    </div>

    <style>
    .two-column-layout {
        padding: 20px 0;
    }

    @media (max-width: 767px) {
        .w-full.md\:w-1/3, .w-full.md\:w-2/3 {
            width: 100%;
        }
    }
    </style>
</div>