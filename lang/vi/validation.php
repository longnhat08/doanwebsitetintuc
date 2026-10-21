<?php

return [
    'required'  => ':attribute không được để trống.',
    'email'     => ':attribute không đúng định dạng email.',
    'string'    => ':attribute phải là chuỗi ký tự.',
    'exists'    => ':attribute không hợp lệ.',
    'in'        => ':attribute không hợp lệ.',
    'unique'    => ':attribute đã tồn tại.',
    'confirmed' => 'Xác nhận :attribute không khớp.',
    'image'     => ':attribute phải là tệp ảnh.',
    'max' => [
        'string' => ':attribute không được vượt quá :max ký tự.',
        'file'   => ':attribute không được vượt quá :max KB.',
    ],
    'min' => [
        'string' => ':attribute phải có ít nhất :min ký tự.',
    ],
    'attributes' => [
        'name'        => 'Tên',
        'email'       => 'Email',
        'password'    => 'Mật khẩu',
        'role'        => 'Vai trò',
        'title'       => 'Tiêu đề',
        'summary'     => 'Tóm tắt',
        'content'     => 'Nội dung',
        'category_id' => 'Chuyên mục',
        'status'      => 'Trạng thái',
        'image'       => 'Ảnh',
        'author_name' => 'Tên người bình luận',
        'subject'     => 'Chủ đề',
        'message'     => 'Nội dung liên hệ',
        'description' => 'Mô tả',
    ],
];
