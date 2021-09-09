@extends('layouts.master')

@section('content')
<h1 style="font-size: 2rem;transform:translate(12vh, 4vh)">{{ sprintf("%02d", count($students))}} | My Children</h1>
<br>
<br>

<div class="bg-grey-100 px-3 font-sans leading-normal tracking-normal">
    <div class="container pt-8 mx-auto" x-data="displayChildren()">
        <input x-ref="searchField" x-model="search" x-on:keydown.window.prevent.slash="$refs.searchField.focus()"
            placeholder="Search for a child..." type="search"
            class="block w-full bg-gray-200 focus:outline-none focus:bg-white focus:shadow text-gray-700 font-bold rounded-lg px-4 py-3" />

        <div class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        </div>
        <template x-for="item in filteredChildren" :key="item">
            <div
                class="flex items-center shadow hover:bg-indigo-100 hover:shadow-lg hover:rounded transition duration-150 ease-in-out transform hover:scale-105 p-3">

                <img
                class="w-10 h-10 rounded-full mr-4"
                :src="`${item.profile_image}`"
              />

                <div class="text-sm">
                    <p class="text-gray-900 leading-none"
                        x-text="item.child_name {{-- + ' (' + item.teacher_gender + ')' --}}">
                    </p>

                    <a class="btn btn-dark btn-sm" :href="`${item.child_link}`">View</a>
                </div>

            </div>
        </template>
    </div>

    <script>
        function displayChildren() {
                return {
                    search: "",
                    myForData: sourceData,
                    get filteredChildren() {
                        if (this.search === "") {
                            return this.myForData;
                        }
                        return this.myForData.filter((item) => {
                            return item.child_name
                                .toLowerCase()
                                .includes(this.search.toLowerCase());
                        });
                    },
                };
            }

            var sourceData = [

                @foreach($students as $student) {
                    'profile_image': "@php echo(isset($student->user->profile_pic) ? '/profile-pic/'.$student->user->profile_pic : '/profile-pic/student.png' ) @endphp",
                    'child_name': "{{$student->user->name}}",
                    'child_link': "{{url("/students/{$student->id}")}}"
                },
                @endforeach
            ];

    </script>
</div>
@endsection
