<div>
    <form action="{{route('tasks.store')}}" enctype="multipart/form-data">
        <p>
            Название
        </p>
        <input type="text" name='name'>
        <p>
            Текст
        </p>
        <input type="text" name='text'>
        <div style='margin-top: 19px;'>
            <input type="submit">
        </div>
    </form>
</div>