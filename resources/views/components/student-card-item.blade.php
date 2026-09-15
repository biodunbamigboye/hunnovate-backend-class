           <li class="student-card">
               <span class="student-avatar-fallback" aria-hidden="true">{{ $initials }}</span>
               <h2 class="student-name">{{ $name }}</h2>
               <p class="student-gender">{{ $gender }}</p>

               <div class="student-details">
                   <div>
                       <span class="detail-label">Course</span>
                       <span class="detail-value">{{ $course }}</span>
                   </div>
                   <div>
                       <span class="detail-label">Duration</span>
                       <span class="detail-value">{{ $duration }}</span>
                   </div>
               </div>
           </li>
