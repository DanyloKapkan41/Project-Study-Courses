document.addEventListener('DOMContentLoaded', function() {
    const courses = [
        {
            id: 1,
            title: "Курс з програмування",
            description: "Детальний курс з основ програмування.",
            image: "programming.jpg",
            duration: "40 годин",
            topic: "Програмування",
            instructor: "Іван Іванов",
            phone: "+380123456789",
            address: "м. Київ, вул. Програмістів, 1",
            hourlyRate: "200 грн",
            hours: 40,
            startDate: "2024-06-01",
            endDate: "2024-08-01",
            totalCost: "8000 грн",
            schedule: "Понеділок, Середа, П'ятниця - 18:00 - 20:00",
            fullDescription: "Цей курс надасть вам всі необхідні знання для початку кар'єри програміста. Ви навчитесь основним принципам програмування, алгоритмам та структурам даних, а також створенню простих програм."
        },
        // Додайте більше курсів за потреби
    ];

    if (document.getElementById('courses-list')) {
        const coursesList = document.getElementById('courses-list');
        courses.forEach(course => {
            const courseCard = document.createElement('div');
            courseCard.classList.add('course-card');
            courseCard.innerHTML = `
                <img src="${course.image}" alt="${course.title}">
                <h3>${course.title}</h3>
                <p>${course.description}</p>
                <p><strong>Тривалість:</strong> ${course.duration}</p>
                <p><strong>Тематика:</strong> ${course.topic}</p>
            `;
            courseCard.addEventListener('click', () => {
                window.location.href = `course.html?id=${course.id}`;
            });
            coursesList.appendChild(courseCard);
        });
    }

    if (window.location.pathname.endsWith('course.html')) {
        const urlParams = new URLSearchParams(window.location.search);
        const courseId = parseInt(urlParams.get('id'));
        const course = courses.find(c => c.id === courseId);
        if (course) {
            document.getElementById('course-image').src = course.image;
            document.getElementById('course-title').textContent = course.title;
            document.getElementById('course-instructor').textContent = course.instructor;
            document.getElementById('instructor-phone').textContent = course.phone;
            document.getElementById('instructor-address').textContent = course.address;
            document.getElementById('hourly-rate').textContent = course.hourlyRate;
            document.getElementById('course-hours').textContent = course.hours;
            document.getElementById('start-date').textContent = course.startDate;
            document.getElementById('end-date').textContent = course.endDate;
            document.getElementById('total-cost').textContent = course.totalCost;
            document.getElementById('schedule').textContent = course.schedule;
            document.getElementById('course-description').textContent = course.fullDescription;
        }
    }
});
