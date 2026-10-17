document.querySelector('.menu')?.addEventListener('click',()=>document.querySelector('header').classList.toggle('open'));
const observer=new IntersectionObserver(items=>items.forEach(item=>{if(item.isIntersecting){item.target.classList.add('visible');observer.unobserve(item.target)}}),{threshold:.12});document.querySelectorAll('.reveal').forEach(item=>observer.observe(item));
