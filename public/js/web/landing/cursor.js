// document.addEventListener('DOMContentLoaded', () => {
//     const cursor = document.querySelector('.custom-cursor');

//     document.addEventListener('mousemove', (e) => {
//         requestAnimationFrame(() => {
//             cursor.style.left = e.clientX + 'px';
//             cursor.style.top = e.clientY + 'px';
//         });
//     });

//     document.addEventListener('mousedown', () => {
//         cursor.classList.add('clicking');
//     });

//     document.addEventListener('mouseup', () => {
//         cursor.classList.remove('clicking');
//     });
// });



// document.addEventListener('DOMContentLoaded', () => {
//     document.documentElement.style.scrollBehavior = 'smooth';
//     document.documentElement.style.scrollbarWidth = 'thin';
//     const style = document.createElement('style');
//     style.innerHTML = `
//         ::-webkit-scrollbar {
//             width: 8px;
//         }
//         ::-webkit-scrollbar-track {
//             background: #1a1a2e;
//         }
//         ::-webkit-scrollbar-thumb {
//             background: linear-gradient(45deg, #ff8c27, #00ccff);
//             border-radius: 10px;
//             transition: background 20s ease;
//         }
//         ::-webkit-scrollbar-thumb:hover {
//             background: linear-gradient(45deg, #ff8c27, #00ccff);
//         }
//     `;
//     document.head.appendChild(style);
// });
