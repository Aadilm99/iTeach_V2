@extends('layouts.master')

@section('content')
<h1 style="font-size: 2rem;transform:translate(12vh, 4vh)">{{ sprintf("%02d", count($parents))}} Parents</h1>

<a class="" href="{{route('parents.create')}}" role="button"><i class="fas fa-plus-circle "
        style="font-size: 3.2rem;transform:translate(140vh, -2vh);color:#8F28FE;"></i></a>
<br>
<br>
<div class="bg-grey-100 px-3 font-sans leading-normal tracking-normal">
    <div class="container pt-8 mx-auto" x-data="displayParents()">
        <input x-ref="searchField" x-model="search" x-on:keydown.window.prevent.slash="$refs.searchField.focus()"
            placeholder="Search for a Parent..." type="search"
            class="block w-full bg-gray-200 focus:outline-none focus:bg-white focus:shadow text-gray-700 font-bold rounded-lg px-4 py-3" />
        <div class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <template x-for="item in filteredParents" :key="item">
                <div
                    class="flex items-center shadow hover:bg-indigo-100 hover:shadow-lg hover:rounded transition duration-150 ease-in-out transform hover:scale-105 p-3">
                    <img class="w-10 h-10 rounded-full mr-4" :src="`${item.profile_image}`" />
                    <div class="text-sm">
                        <p class="text-gray-900 leading-none"
                            x-text="item.parent_name {{-- + ' (' + item.teacher_gender + ')' --}}"></p>
                        <p {{-- class="text-gray-600"
                 x-text="'$'+item.employee_salary/100" --}} class="text-gray-600" x-text="item.parent_email"></p>
                        <a class="btn btn-dark btn-sm" :href="`${item.parent_link}`">View</a>
                    </div>

                </div>
            </template>
        </div>
    </div>
    <script>
        function displayParents() {
            return {
                search: "",
                myForData: sourceData,
                get filteredParents() {
                    if (this.search === "") {
                        return this.myForData;
                    }
                    return this.myForData.filter((item) => {
                        return item.parent_name
                            .toLowerCase()
                            .includes(this.search.toLowerCase());
                    });
                },
            };
        }

        var sourceData = [

            @foreach($parents as $parent) {
                'parent_name': "{{$parent->user->name}}",
                'parent_email': "{{$parent->user->email}}",
                'parent_link': "{{url("/parents/{$parent->id}")}}",
                'profile_image': "@php echo(isset($parent->user->profile_pic) ? '/profile-pic/'.$parent->user->profile_pic :
                '/profile-pic/users.png' ) @endphp",
            },
            @endforeach
            /* id: "1",
           employee_name: "Tiger Nixon",
           employee_salary: "320800",
           employee_age: "61",
           profile_image: "https://randomuser.me/api/portraits/men/1.jpg",
         }, */
        ];

    </script>
    <div class="mt-8">
        {{ $parents->links() }}
    </div>
</div>

@endsection
