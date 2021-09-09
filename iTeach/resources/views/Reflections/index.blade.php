@extends('layouts.master')

@section('content')
<h1 class="mb-1 text-gray-800 p-4"> {{ sprintf("%02d", count($reflections))}} My Reflections</h1>
{{-- <a class="" href="{{ route('reflections.create') }}" role="button"><i class="fas fa-plus-circle "
    style="font-size: 3.2rem;transform:translate(140vh, -2vh); color:#8F28FE"></i></a> --}}

<div class="bg-grey-100 px-3 font-sans leading-normal tracking-normal">
    <div class="container pt-8 mx-auto" x-data="displayReflections()">
        <input x-ref="searchField" x-model="search" x-on:keydown.window.prevent.slash="$refs.searchField.focus()"
            placeholder="Search for a Classes..." type="search"
            class="block w-full bg-gray-200 focus:outline-none focus:bg-white focus:shadow text-gray-700 font-bold rounded-lg px-4 py-3" />

        <div class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        </div>
        <template x-for="item in filteredReflections" :key="item">

            <div class="flex items-center shadow hover:bg-indigo-100 hover:shadow-lg hover:rounded transition duration-150 ease-in-out transform hover:scale-105 p-3 mb-3">

                <div class="text-base" style="display: inline">
                    <h5 class="text-gray-900 leading-none font-bold" style="display: inline" x-text="item.reflection_title">
                    </h5>
                    <span style="display: inline">{{ "|" }}</span>
                    <h5 class="text-gray-900 leading-none font-semibold" style="display: inline" x-text="item.reflection_class_title">
                    </h5>
                    <span style="display: inline">{{ "|" }}</span>
                    <h5 class="text-gray-900 leading-none font-semibold" style="display: inline">Year Group :</h5>
                    <h5 class="text-gray-900 leading-none font-semibold" style="display: inline" x-text="item.reflection_group">
                    </h5>

                    <p class="text-gray-600 leading-none"
                        x-text="item.reflection_description">
                    </p>
                    <a class="btn btn-dark btn-sm" :href="`${item.reflection_link}`">View</a>

                    <h6 class="text-gray-900 leading-none font-semibold " style="position: relative;left:480px;top:30px">Created by :
                    <h6 class="text-gray-900 leading-none font-bold " style="position: relative;left:570px;top:6px"
                        x-text="item.reflection_created"></h6>
                    </h6>

                </div>

            </div>
        </template>
    </div>

    <script>
        function displayReflections() {
            return {
                search: "",
                myForData: sourceData,
                get filteredReflections() {
                    if (this.search === "") {
                        return this.myForData;
                    }
                    return this.myForData.filter((item) => {
                        return item.reflection_title
                            .toLowerCase()
                            .includes(this.search.toLowerCase());
                    });
                },
            };
        }

        var sourceData = [

            @foreach($reflections as $reflection) {
                'reflection_title': "{{ucwords($reflection->title)}}",
                'reflection_description': "{{ucwords($reflection->description)}}",
                'reflection_class_title': "{{ucwords($reflection->class->title)}}",
                'reflection_group': "{{ucwords($reflection->class->years[0]['years'])}}",
                'reflection_created': "{{ucwords($reflection->user->name)}}",
                'reflection_link': "{{url("/reflection/view/{$reflection->id}")}}"
            },

            @endforeach
        ];

    </script>
</div>
@endsection
