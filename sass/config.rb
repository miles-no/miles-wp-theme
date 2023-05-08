require 'compass/import-once/activate'
# Require any additional compass plugins here.
require 'fileutils'

project_path = File.expand_path(File.join(File.dirname(__FILE__), '..'))

# Set this to the root of your project when deployed:
http_path = "/"
css_dir = ""
sass_dir = "sass"
images_dir = "images"
javascripts_dir = "js"
fonts_dir = "fonts"

output_style = :expanded

# To enable relative paths to assets via compass helper functions. Uncomment:
# relative_assets = true

# To disable debugging comments that display the original location of your selectors. Uncomment:
# line_comments = false
color_output = false

preferred_syntax = :scss

#on_stylesheet_saved do |file|
#  if File.exists?(file) && File.basename(file) == "style.css"
#   puts "Copying : #{file}"
#   FileUtils.cp(file, File.dirname(file) + "/../" + File.basename(file))
#  end
#end

