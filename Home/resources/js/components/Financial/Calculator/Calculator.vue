<template>
    <div class="container mx-auto sm:w-3/4 md:w-3/4 lg:w-3/4 xl:w-3/4">
        <div>
            <div class="flex">
                <div
                    class="text-center w-full bg-gray-300 border border-gray-700 h-12 pt-3"
                >
                    {{ total }}
                </div>
            </div>
            <div class="flex">
                <div
                    class="text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    %
                </div>
                <div
                    class="text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    CE
                </div>
                <div
                    class="text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    C
                </div>
                <div
                    class="text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    /
                </div>
            </div>
            <div class="flex">
                <div
                    class="text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    7
                </div>
                <div
                    class="text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    8
                </div>
                <div
                    class="text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    9
                </div>
                <div
                    class="text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    x
                </div>
            </div>

            <div class="flex">
                <div
                    class="text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    4
                </div>
                <div
                    class="text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    5
                </div>
                <div
                    class="text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    6
                </div>
                <div
                    class="text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    -
                </div>
            </div>

            <div class="flex">
                <div
                    class=" text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    1
                </div>
                <div
                    class=" text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    2
                </div>
                <div
                    class=" text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    3
                </div>
                <div
                    class=" text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    +
                </div>
            </div>

            <div class="flex">
                <div
                    class=" text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    +/-
                </div>
                <div
                    class=" text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    0
                </div>
                <div
                    class=" text-center w-1/4 bg-gray-500 border border-gray-700 h-12 pt-2"
                >
                    .
                </div>
                <div
                    class=" text-center w-1/4 bg-gray-600 border border-gray-700 h-12 pt-2"
                >
                    =
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            total: 0
        };
    }
};
</script>

<style scoped></style>
