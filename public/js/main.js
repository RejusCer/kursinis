const showCommentFormBtn = document.querySelector('#show-comment-form')
const commentPostForm = document.querySelector('#comment-post-form')

if(showCommentFormBtn){
    showCommentFormBtn.addEventListener('click', function(){
        commentPostForm.classList.toggle('hidden')
    })
}


document.addEventListener('DOMContentLoaded', function() {
    const messageBox = document.querySelector('#message-box')

    // Hide the message box after 5 seconds
    setTimeout(function() {
        messageBox.style.opacity = '0';
    }, 2000)

    setTimeout(function() {
        messageBox.classList.add('hidden')
    }, 3000)
})
