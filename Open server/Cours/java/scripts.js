document.addEventListener('DOMContentLoaded', function() {
    fetch('api/get_courses.php')
        .then(response => response.json())
        .then(courses => {
            console.log(courses);
            if (document.getElementById('courses-list')) {
                const coursesList = document.getElementById('courses-list');
                courses.forEach(course => {
                    const courseCard = document.createElement('div');
                    courseCard.classList.add('course-card');
                    const photoPath = course.PhotoPath ? course.PhotoPath : 'img/default-teacher.jpg';
                    courseCard.innerHTML = `
                        <img src="${photoPath}" alt="Фото викладача" class="teacher-photo">
                        <h3>${course.CourseName}</h3>
                        <p><strong>Викладач:</strong> ${course.Name} ${course.Surname}</p>
                        <p><strong>Вартість одного заняття:</strong> ${course.HourlyRate}</p>
                        <p><strong>Кількість годин:</strong> ${course.CourseHours}</p>
                        <p><strong>Дата початку:</strong> ${course.StartDate}</p>
                        <p><strong>Дата завершення:</strong> ${course.EndDate}</p>
                    `;
                    courseCard.addEventListener('click', () => {
                        window.location.href = `course.php?id=${course.CourseID}`;
                    });
                    coursesList.appendChild(courseCard);
                });
            }
        })
        .catch(error => console.error('Error fetching courses:', error));
});
