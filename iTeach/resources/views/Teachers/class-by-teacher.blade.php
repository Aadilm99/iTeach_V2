@extends('layouts.master')

@section('content')
<h1 style="font-size: 2rem;transform:translate(12vh, 4vh)">{{ sprintf("%02d", count($classes))}} Classes</h1>
<br>
<br>
@if(count($classes) > 0)
<div class="bg-grey-100 px-3 font-sans leading-normal tracking-normal">
    <div class="container pt-8 mx-auto" x-data="displayClasses()">
        <input x-ref="searchField" x-model="search" x-on:keydown.window.prevent.slash="$refs.searchField.focus()"
            placeholder="Search for a Classes..." type="search"
            class="block w-full bg-gray-200 focus:outline-none focus:bg-white focus:shadow text-gray-700 font-bold rounded-lg px-4 py-3" />

        <div class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        </div>
        <template x-for="item in filteredClasses" :key="item">
            <div
                class="flex items-center shadow hover:bg-indigo-100 hover:shadow-lg hover:rounded transition duration-150 ease-in-out transform hover:scale-105 p-3">

                <div class="text-sm">
                    <p class="text-gray-900 leading-none"
                        x-text="item.class_title {{-- + ' (' + item.teacher_gender + ')' --}}">
                    </p>
                    <p {{-- class="text-gray-600"
                         x-text="'$'+item.employee_salary/100" --}} class="text-gray-600" x-text="item.class_description">
                    </p>
                    <a class="btn btn-dark btn-sm" :href="`${item.parent_link}`">View</a>
                </div>

            </div>
        </template>
    </div>

    <script>
        function displayClasses() {
                return {
                    search: "",
                    myForData: sourceData,
                    get filteredClasses() {
                        if (this.search === "") {
                            return this.myForData;
                        }
                        return this.myForData.filter((item) => {
                            return item.class_title
                                .toLowerCase()
                                .includes(this.search.toLowerCase());
                        });
                    },
                };
            }

            var sourceData = [

                @foreach($classes as $class) {
                    'class_title': "{{$class->title}}",
                    'class_description': "{{$class->description}}",
                    'parent_link': "{{url("/classes/{$class->id}")}}"
                },
                @endforeach
            ];

    </script>
</div>
@else
<p style="color: #000;">You don't have any classes, Please wait for Admin to assign you classes</p>
@endif
@endsection
