           <li class="student-card">
               <span class="student-avatar-fallback" aria-hidden="true">{{ $student->initials }}</span>
               <h2 class="student-name">{{ $student->name }}</h2>
               <p class="student-gender">{{ $student->gender }}</p>

               <div class="student-details">

                   @if($student->myCourse)
                   <div>
                       <span class="detail-label">Course</span>
                       <span class="detail-value">{{ $student->myCourse->name }}</span>
                   </div>
                   @else
                     <div>
{{--                      Create Form input to select and save course  --}}
                         <form action="{{ route('assign-course', $student->id) }}" method="POST">
                             @csrf
                             <label for="course">Assign Course:</label>
                             <select name="course_id" id="course" required>
                                 @foreach($courses as $course)
                                     <option value="{{ $course->id }}">{{ $course->name }}</option>
                                     <option value="343455"> Wrong Course</option>
                                 @endforeach
                             </select>
                             <button type="submit">Assign</button>
                             @error('course_id')
                                 {{ $message }}
                             @enderror
                         </form>
                     </div>
                   @endif

                   <div>
                       <span class="detail-label">Duration</span>
                       <span class="detail-value">{{ $student->duration }}</span>
                   </div>
               </div>
           </li>
