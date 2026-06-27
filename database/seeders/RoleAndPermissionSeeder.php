<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'dashboard.view',

            'article.create',
            'article.read',
            'article.update',
            'article.delete',
            'article.publish',
            'article.approve',
            'article.review',
            'article.fact-check',
            'article.schedule',
            'article.feature',
            'article.view-all',

            'category.create',
            'category.read',
            'category.update',
            'category.delete',

            'tag.create',
            'tag.read',
            'tag.update',
            'tag.delete',

            'media.create',
            'media.read',
            'media.update',
            'media.delete',

            'user.create',
            'user.read',
            'user.update',
            'user.delete',

            'role.create',
            'role.read',
            'role.update',
            'role.delete',

            'advertisement.create',
            'advertisement.read',
            'advertisement.update',
            'advertisement.delete',

            'newsletter.create',
            'newsletter.read',
            'newsletter.update',
            'newsletter.delete',
            'newsletter.send',

            'settings.read',
            'settings.update',

            'seo.read',
            'seo.update',

            'audit.read',

            'comment.moderate',
            'comment.delete',

            'breaking-news.create',
            'breaking-news.update',
            'breaking-news.delete',

            'subscriber.read',
            'subscriber.export',

            'video.create',
            'video.read',
            'video.update',
            'video.delete',

            'podcast.create',
            'podcast.read',
            'podcast.update',
            'podcast.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());

        $ceo = Role::firstOrCreate(['name' => 'CEO', 'guard_name' => 'web']);
        $ceo->syncPermissions(Permission::all());

        $md = Role::firstOrCreate(['name' => 'Managing Director', 'guard_name' => 'web']);
        $md->syncPermissions(Permission::all());

        $editorInChief = Role::firstOrCreate(['name' => 'Editor In Chief', 'guard_name' => 'web']);
        $editorInChief->syncPermissions([
            'dashboard.view',
            'article.create', 'article.read', 'article.update', 'article.delete',
            'article.publish', 'article.approve', 'article.schedule', 'article.feature',
            'article.fact-check', 'article.review', 'article.view-all',
            'category.create', 'category.read', 'category.update', 'category.delete',
            'tag.create', 'tag.read', 'tag.update', 'tag.delete',
            'media.create', 'media.read', 'media.update', 'media.delete',
            'comment.moderate', 'comment.delete',
            'breaking-news.create', 'breaking-news.update', 'breaking-news.delete',
            'seo.read', 'seo.update',
            'subscriber.read',
            'video.create', 'video.read', 'video.update', 'video.delete',
            'podcast.create', 'podcast.read', 'podcast.update', 'podcast.delete',
        ]);

        $managingEditor = Role::firstOrCreate(['name' => 'Managing Editor', 'guard_name' => 'web']);
        $managingEditor->syncPermissions([
            'dashboard.view',
            'article.create', 'article.read', 'article.update', 'article.publish',
            'article.approve', 'article.schedule', 'article.feature', 'article.review',
            'article.view-all',
            'category.read', 'category.update',
            'tag.create', 'tag.read', 'tag.update',
            'media.create', 'media.read', 'media.update',
            'comment.moderate',
            'breaking-news.create', 'breaking-news.update',
            'seo.read', 'seo.update',
        ]);

        $publisher = Role::firstOrCreate(['name' => 'Publisher', 'guard_name' => 'web']);
        $publisher->syncPermissions([
            'dashboard.view',
            'article.read', 'article.update', 'article.publish', 'article.approve',
            'article.schedule', 'article.view-all',
            'category.read',
            'tag.read',
            'media.read',
            'seo.read',
        ]);

        $journalist = Role::firstOrCreate(['name' => 'Journalist', 'guard_name' => 'web']);
        $journalist->syncPermissions([
            'dashboard.view',
            'article.create', 'article.read', 'article.update',
            'category.read',
            'tag.read',
            'media.create', 'media.read',
        ]);

        $reporter = Role::firstOrCreate(['name' => 'Reporter', 'guard_name' => 'web']);
        $reporter->syncPermissions([
            'dashboard.view',
            'article.create', 'article.read',
            'category.read',
            'tag.read',
        ]);

        $factChecker = Role::firstOrCreate(['name' => 'Fact Checker', 'guard_name' => 'web']);
        $factChecker->syncPermissions([
            'dashboard.view',
            'article.read', 'article.fact-check',
            'category.read',
            'tag.read',
        ]);

        $advertiser = Role::firstOrCreate(['name' => 'Advertiser', 'guard_name' => 'web']);
        $advertiser->syncPermissions([
            'dashboard.view',
            'advertisement.create', 'advertisement.read', 'advertisement.update', 'advertisement.delete',
        ]);

        $subscriber = Role::firstOrCreate(['name' => 'Subscriber', 'guard_name' => 'web']);
        $subscriber->syncPermissions([
            'dashboard.view',
        ]);

        $visitor = Role::firstOrCreate(['name' => 'Visitor', 'guard_name' => 'web']);
    }
}
