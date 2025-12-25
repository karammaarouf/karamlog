<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;


trait translatable
{
    /**
     * Get the translatable attributes.
     * جلب السمات (الحقول) القابلة للترجمة في النموذج.
     * @return array
     */
    abstract public function getTranslatableAttributes(): array;


    /**
     * Boot the translatable trait.
     * تهيئة السمة (Trait) ليتم تحميل الترجمات تلقائيًا عند جلب النموذج من قاعدة البيانات.
     * This will set the translatable attributes on the model.
     * when the model is retrieved from the database.
     *
     * @return void
     */
    protected function bootTranslatable(): void
    {

        static::retrieved(function ($model) {
            foreach ($model->getTranslatableAttributes() as $field) {
                $model->appendTranslation($field);
            }
        });
    }
    
    /**
     * Save the translation.
     * حفظ الترجمات للحقول القابلة للترجمة من البيانات الممررة.
     * @param array $data البيانات التي تحتوي على القيم المترجمة (يجب أن تكون مصفوفة وليست نصاً كما هو مكتوب في النوع)
     * @param string $locale اللغة المراد حفظ الترجمة لها
     * @param string $value
     * @return void
     */
    public function saveTranslation(mixed $data, string $locale=null): void
    {
        // تم تغيير نوع data إلى mixed أو array لأن الكود يعاملها كمصفوفة
        $locale = $locale ?? app()->getLocale();
        $translatableFields = $this->getTranslatableAttributes();
        foreach ($translatableFields as $field) {
            if(isset($data[$field])){
                $this->setTranslation($field, $data[$field], $locale);
            }
        }
    }
    /**
     * Set the translation.
     * وضع وحفظ قيمة ترجمة لحقل معين في ملف الترجمة JSON.
     * @param string $field اسم الحقل
     * @param string $value قيمة الترجمة
     * @param string $locale كود اللغة
     * @return void
     */
    public function setTranslation(string $field, string $value, string $locale): void
    {
        $key=$this->getTranslationKey($field);
        $filePath = $this->getTranslationFilePath($locale);
        $translations=$this->loadTranslations($locale);
        $translations[$key] = $value;
        $this->saveToFile($filePath, $translations);
    }
    /**
     * Get the translation.
     * جلب قيمة الترجمة لحقل معين بلغة معينة.
     * @param string $field اسم الحقل
     * @param string|null $locale كود اللغة (اختياري)
     * @return string|null
     */
    public function getTranslation(string $field,string $locale=null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        $key=$this->getTranslationKey($field);
        $translations=$this->loadTranslations($locale);
        return $translations[$key] ?? null;
    }
    /**
     * Append the translation to the model.
     * إلحاق قيمة الترجمة بخصائص النموذج الحالية لتحل محل القيمة الأصلية أو تضاف إليها.
     * @param string $field اسم الحقل
     * @return void
     */
    public function appendTranslation(string $field): void
    {
        $translation = $this->getTranslation($field);
        if ($translation) {
            $this->attributes[$field] = $translation;
        }
    }
    /**
     * Get the translation key.
     * توليد مفتاح فريد للترجمة في ملف JSON (اسم الموديل + المعرف + اسم الحقل).
     * @param string $field اسم الحقل
     * @return string
     */
    public function getTranslationKey(string $field): string
    {
        $modelName=strtolower(string: class_basename(class: $this));
        return "models.{$modelName}.{$this->id}.{$field}";
    }
    /**
     * Get the translation path.
     * الحصول على مسار ملف الترجمة JSON بناءً على اللغة.
     * @param string $locale كود اللغة
     * @return string
     */
    public function getTranslationFilePath(?string $locale=null): string
    {
        $locale = $locale ?? app()->getLocale() ?? config('app.locale');
        return lang_path("{$locale}/models.json");
    }
    /**
     * Load the translations.
     * تحميل محتوى ملف الترجمات وتحويله إلى مصفوفة.
     * @param string $locale كود اللغة
     * @return array
     */
    public function loadTranslations(?string $locale=null): array
    {
        $locale = $locale ?? app()->getLocale() ?? config('app.locale');
        $filePath = $this->getTranslationFilePath($locale);
        if(!File::exists($filePath)){
            File::ensureDirectoryExists( dirname($filePath));
            return [];
        }
        $content=File::get($filePath);
        return json_decode($content, true) ?? [];
    }
    /**
     * Save the translations to the file.
     * حفظ مصفوفة الترجمات في ملف JSON بشكل منسق.
     * @param string $filePath مسار الملف
     * @param array $translations مصفوفة الترجمات
     * @return void
     */
    public function saveToFile(string $filePath, array $translations): void
    {
        File::ensureDirectoryExists( dirname($filePath));
        File::put($filePath, json_encode($translations, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    }

    /**
     * تجاوز دالة جلب السمات (Accessor) الأصلية للموديل.
     * إذا كان الحقل قابلاً للترجمة والنموذج موجود، يتم جلب الترجمة بدلاً من القيمة الأصلية.
     */
    public function getAttribute($key):mixed
    {
        $value=parent::getAttribute($key);
        if(in_array($key, $this->getTranslatableAttributes())&& $this->exists){
            $translation=$this->getTranslation($key);
            return $translation ?? $value;
        }
        return $value;
    }
}
