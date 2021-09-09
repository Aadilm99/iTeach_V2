@extends('layouts.master')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/tom-select@1.1/dist/css/tom-select.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-4 border-right">
        <div class="card border-bottom-primary shadow h-100 py-40">
            <h1 class="mb-1 text-gray-800 p-4" style="transform: translateY(-16vh)">Class Information</h1>

            <div class="card-body" style="transform: translateY(-80px)">
                @if($class->profile_image)
                    <img class="mb-4" src="{{ asset('/profile-pic/'.$class->profile_image) }}">

                    @else
                    <img class="mb-4"
                        src="{{asset('/profile-pic/books.png')}}"
                        alt="">
                @endif

                <h1 class="mb-0">Title: {{$class->title}}</h1>
                <br>
                <h3>Description:<br> {{$class->description}}</h3>
                <br>
                <h3>
                    @foreach ($class->years as $classYear)
                    Year Group: {{$classYear->years}}
                    @endforeach
                </h3>
                <br>
                <h3>
                    Teacher Assigned: {{$teachers->user->name}}
                </h3>
                <br>
                @if (!Auth::user()->hasRole('Parent'))


                <div class="row">
                    <a href="{{url("/classes/{$class->id}/edit")}}"
                        class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-3 rounded"
                        style="text-decoration: none" type="submit">Edit Class</a>
                        @if ( !Auth::user()->hasRole('Teacher') )
                    <form action="{{route('classes.destroy',$class->id)}}" method="POST" onsubmit="return confirm('Do you want to delete ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" style="display: inline; margin-left:3px" type="submit">Delete Class</button>
                    </form>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-8">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            </div>
        </div>
        <div class="card border-bottom-warning shadow h-100 py-2">
            <h1 class="mb-0 text-gray-800 p-4">Students</h1>
            @if ( !Auth::user()->hasRole('Parent') )

            <div class="auto-rows-auto">
                <div class="col-span-12">
                    @if ( !Auth::user()->hasRole('Admin'))
                    <a class="btn btn-success absolute" style="left: 28px" href="{{ route('reflection.create', $class->id) }}">
                        <i class="fas fa-pen inline" style="color: #ffffff;"></i>
                        Create Reflection
                    </a>
                    @endif
                    @if ( !Auth::user()->hasRole('Teacher') )
                    <button class="btn btn-success absolute" onclick="toggleModal('allstudent')"
                        style="color: #ffffff;background-color:#8F28FE;border-color:#8F28FE;left:28px" role="button"><i
                            class="fas fa-plus inline" style="color: #ffffff;"></i> Assign
                        Student</button>
                        @endif
                </div>
            </div>
            @endif
            <div class="card-body">
                <div class="bg-grey-100 px-3 font-sans leading-normal tracking-normal">
                    <div class="container pt-8 mx-auto">
                        <table class="min-w-full divide-y divide-gray-200 data-table">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Address
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Gender
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date of birth
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if(isset($class->student))
                                @foreach ($class->student as $student)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($student->user->profile_pic)
                                                <img class="h-10 w-10 rounded-full" src="{{ asset('/profile-pic/'.$student->user->profile_pic) }}">
                                                 @else
                                                 <img class="h-10 w-10 rounded-full"
                                                    src="{{ asset('/profile-pic/student.png') }}"
                                                    alt="">
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $student->user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $student->user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $student->current_address }}</div>
                                        <div class="text-sm text-gray-500">{{ $student->permanent_address }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ strtoupper($student->gender) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $student->dateOfbirth }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('students.show',$student->id) }}" class="btn btn-warning btn-sm text-indigo-600 hover:text-indigo-900" style="display: inline;">View</a>
                                        @if ( !Auth::user()->hasRole('Teacher') )
                                        <form action="{{ route('remove.student', [$class->id, $student->id]) }}"
                                              onsubmit="return confirm('Do you want to remove students ?')"
                                              method="POST"

                                              >
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    style="color: #ffffff; transform:translate(40px, -26px)"><i class="fa fa-trash" style="display: inline"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script>
                function displayStudents() {
                    return {
                        search: "",
                        myForData: sourceData,
                        get filteredStudents() {
                            if (this.search === "") {
                                return this.myForData;
                            }
                            return this.myForData.filter((item) => {
                                return item.student_name
                                    .toLowerCase()
                                    .includes(this.search.toLowerCase());
                            });
                        },
                    };
                }
                var sourceData = [
                    @foreach($students as $student) {
                        'student_name': "{{$student->user->name}}",
                        'student_link': "{{url(" / students / {
                            $student - > id
                        }
                        ")}}"
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
        </div>
    </div>

    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center"
        id="allstudent">
        <div class="relative w-full my-6 mx-auto max-w-3xl">
            <!--content-->
            <div
                class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                <!--header-->
                <div class="flex items-start justify-between p-5 border-b border-solid border-gray-200 rounded-t">
                    <h3>
                        Select Student
                    </h3>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <form action="{{ route('classes.student') }}" method="POST">
                    @csrf
                    <!--body-->
                    <div class="relative p-6 flex-auto">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <select class="tom-select w-full mt-1" name="studentName" id="studentName" required>
                                    <option value="">Please choose</option>
                                    @foreach ($allStudents as $allstudent)
                                    <option value="{{ $allstudent->id }}">Name: {{ $allstudent->user->name }} | Email: {{ $allstudent->user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="class_id" value="{{  $class->id  }}">
                    <!--footer-->
                    <div class="flex items-center justify-end p-6 border-t border-solid border-gray-200 rounded-b">
                        <button class="btn btn-danger mr-1" type="button" onclick="window.location.reload()">
                            Close
                        </button>
                        <button class="btn btn-success mr-1" type="submit"
                            onclick="toggleModal('modal-example-regular')">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="hidden opacity-50 backdrop-opacity-50 fixed inset-0 z-40 bg-black" id="allstudent-backdrop"></div>
    <script type="text/javascript">
        function toggleModal(modalID) {
            document.getElementById(modalID).classList.toggle("hidden");
            document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
            document.getElementById(modalID).classList.toggle("flex");
            document.getElementById(modalID + "-backdrop").classList.toggle("flex");
        }

    </script>

    @section('js')

    <script src="https://cdn.jsdelivr.net/npm/tom-select@1.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        var config = {};
        new TomSelect('#studentName', config);

    </script>
    @endsection
    @endsection
