# All files in the 'lib' directory will be loaded
# before nanoc starts compiling.

require 'nanoc/filters/image_compressor'

String.class_eval do
  def to_slug
    downcase.strip.gsub(' ', '-').gsub(/[^\w-]/, '')
  end
end
